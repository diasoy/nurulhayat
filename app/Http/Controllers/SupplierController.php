<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class SupplierController extends Controller
{
    public function index()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('slug', 'supplier');
        })
            ->whereDoesntHave('roles', function ($q) {
                $q->where('slug', '!=', 'supplier');
            })
            ->get();

        return view('Admin.supplier.index', compact('users'));
    }

    public function create()
    {
        return view('Admin.supplier.create');
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

        $role = Role::where('slug', 'supplier')->first();
        $user->roles()->attach($role);

        return redirect()->route('admin.supplier.index')->with('success', 'User supplier berhasil dibuat.');
    }

    public function show($id)
    {
        $user = User::with(['supplierOrders' => function ($query) {
            $query->orderBy('pelaksanaan_tanggal', 'asc')
                ->orderBy('jam_matang', 'asc');
        }])->findOrFail($id);

        return view('Admin.supplier.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.supplier.edit', compact('user'));
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

        $role = Role::where('slug', 'supplier')->first();
        $user->roles()->sync([$role->id]);

        return redirect()->route('admin.supplier.index')->with('success', 'User supplier berhasil diupdate.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.supplier.index')->with('success', 'User supplier berhasil dihapus.');
    }

    public function dashboard(Request $request)
    {
        // Validate supplier role
        if (!auth()->user()->hasRole('supplier')) {
            abort(403, 'Unauthorized');
        }

        // Get supplier ID
        $supplierId = auth()->id();

        // Set default filter value
        $filter = $request->input('filter', 'month');
        $now = Carbon::now();

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

        // Get statistics for specific supplier
        $statistics = $this->getMainStatistics($start, $end, $supplierId);

        // Get order trend
        $orderTrend = $this->getOrderTrend($start, $end, $supplierId, $filter);

        // Get menu analytics
        $menuAnalytics = $this->getMenuAnalytics($start, $end, $supplierId);

        // Get upcoming schedule
        $jadwalSupplier = $this->getSupplierSchedule($supplierId);

        return view('Supplier.dashboard.dashboard', compact(
            'filter',
            'statistics',
            'orderTrend',
            'menuAnalytics',
            'jadwalSupplier'
        ));
    }

    private function getMainStatistics($start, $end, $supplierId)
    {
        return Order::where('supplier_id', $supplierId)
            ->whereBetween('pelaksanaan_tanggal', [$start, $end])
            ->selectRaw('
                COUNT(*) as total_order,
                SUM(CASE WHEN status_supplier = "Terkirim" THEN 1 ELSE 0 END) as order_selesai,
                SUM(CASE WHEN status_supplier = "Diproses" THEN 1 ELSE 0 END) as order_proses,
                SUM(CASE WHEN status_supplier = "Belum Diproses" THEN 1 ELSE 0 END) as order_pending,
                SUM(quantity) as total_kambing
            ')
            ->first()
            ->toArray();
    }

    private function getOrderTrend($start, $end, $supplierId, $filter)
    {
        return Order::where('supplier_id', $supplierId)
            ->whereBetween('pelaksanaan_tanggal', [$start, $end])
            ->select(
                DB::raw("DATE_FORMAT(pelaksanaan_tanggal, '%Y-%m-%d') as date"),
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(quantity) as total_kambing')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getMenuAnalytics($start, $end, $supplierId)
    {
        return Order::where('supplier_id', $supplierId)
            ->whereBetween('pelaksanaan_tanggal', [$start, $end])
            ->select(
                'menu_option',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(quantity) as total_kambing')
            )
            ->groupBy('menu_option')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
    }

    private function getSupplierSchedule($supplierId)
    {
        return Order::where('supplier_id', $supplierId)
            ->where('pelaksanaan_tanggal', '>=', now())
            ->where('status_supplier', '!=', 'Terkirim')
            ->orderBy('pelaksanaan_tanggal')
            ->orderBy('pelaksanaan_jam')
            ->get()
            ->groupBy('pelaksanaan_tanggal');
    }
}
