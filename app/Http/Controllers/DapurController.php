<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DapurController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('slug', 'dapur');
        })
            ->whereDoesntHave('roles', function ($q) {
                $q->where('slug', '!=', 'dapur');
            })
            ->get();

        return view('Admin.dapur.index', compact('users'));
    }

    public function create()
    {
        return view('Admin.dapur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::where('slug', 'dapur')->first();
        $user->roles()->attach($role);

        return redirect()->route('admin.dapur.index')->with('success', 'User dapur berhasil dibuat.');
    }

    public function show($id)
    {
        $user = User::with(['dapurOrders' => function ($query) {
            $query->orderBy('pelaksanaan_tanggal', 'asc')
                ->orderBy('jam_matang', 'asc');
        }])->findOrFail($id);

        return view('Admin.dapur.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.dapur.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // Pastikan role tetap dapur
        $role = Role::where('slug', 'dapur')->first();
        $user->roles()->sync([$role->id]);

        return redirect()->route('dapur-users.index')->with('success', 'User dapur berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('dapur-users.index')->with('success', 'User dapur berhasil dihapus.');
    }

    public function dashboard(Request $request)
    {
        // Set default filter value
        $filter = $request->input('filter', 'month'); // Changed default to 'month'
        $now = Carbon::now();
        $dapurId = auth()->id();

        // Set periode berdasarkan filter
        switch ($filter) {
            case 'month':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                break;
            case 'week':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                break;
            case 'year':
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfYear();
                break;
            default:
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
        }

        // Statistik Utama
        $statistics = $this->getMainStatistics($start, $end, $dapurId);

        // Tren Order
        $orderTrend = $this->getOrderTrend($start, $end, $dapurId, $filter);

        // Menu Analytics
        $menuAnalytics = $this->getMenuAnalytics($start, $end, $dapurId);

        // Jadwal Dapur
        $jadwalDapur = $this->getDapurSchedule($dapurId);

        // Make sure to pass all required variables to the view
        return view('Dapur.dashboard.dashboard', compact(
            'filter',
            'statistics',
            'orderTrend',
            'menuAnalytics',
            'jadwalDapur'
        ));
    }

    private function getMainStatistics($start, $end, $dapurId)
    {
        $orders = Order::where('dapur_id', $dapurId)
            ->whereBetween('pelaksanaan_tanggal', [$start, $end]);

        return [
            'total_order' => $orders->count(),
            'order_selesai' => $orders->where('status_dapur', 'Terkirim')->count(),
            'order_proses' => $orders->where('status_dapur', 'Diproses')->count(),
            'order_pending' => $orders->where('status_dapur', 'Belum Diproses')->count(),
        ];
    }

    private function getOrderTrend($start, $end, $dapurId, $filter)
    {
        $groupBy = $filter == 'year' ? 'month' : 'day';

        return Order::where('dapur_id', $dapurId)
            ->whereBetween('pelaksanaan_tanggal', [$start, $end])
            ->select(
                DB::raw("DATE_FORMAT(pelaksanaan_tanggal, '%Y-%m-%d') as date"),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getMenuAnalytics($start, $end, $dapurId)
    {
        return Order::where('dapur_id', $dapurId)
            ->whereBetween('pelaksanaan_tanggal', [$start, $end])
            ->select('menu_option', DB::raw('COUNT(*) as total'))
            ->groupBy('menu_option')
            ->orderByDesc('total')
            ->get();
    }

    private function getDapurSchedule($dapurId)
    {
        return Order::where('dapur_id', $dapurId)
            ->where('pelaksanaan_tanggal', '>=', now())
            ->orderBy('pelaksanaan_tanggal')
            ->orderBy('pelaksanaan_jam')
            ->get()
            ->groupBy('pelaksanaan_tanggal');
    }
}
