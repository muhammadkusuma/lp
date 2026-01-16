@extends('layouts.dashboard')

@section('title', 'Buat Slip Gaji')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <h4 class="font-bold mb-1">ℹ️ Buat Slip Gaji Baru</h4>
            <p>Pilih karyawan dan periode penggajian. Gaji pokok akan otomatis terisi berdasarkan data karyawan, namun dapat disesuaikan jika perlu.</p>
        </div>

        <form action="{{ route('salary-slips.store') }}" method="POST" class="bg-white p-6 win-border max-w-4xl" x-data="salaryCalculator()">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                {{-- Column 1: Employee & Period --}}
                <div class="space-y-4">
                    <h3 class="font-bold text-gray-700 border-b pb-2">Data Karyawan & Periode</h3>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Karyawan <span class="text-red-500">*</span></label>
                        <select name="employee_id" id="employee_select" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border bg-white" required @change="updateSalary($event.target)">
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" data-salary="{{ $employee->salary }}">
                                    {{ $employee->full_name }} ({{ $employee->position }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Bulan</label>
                            <select name="period_month" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border bg-white" required>
                                @foreach(range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ date('n') == $m ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tahun</label>
                            <input type="number" name="period_year" value="{{ date('Y') }}" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border" required>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Pembayaran <span class="text-red-500">*</span></label>
                        <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border" required>
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Status Pembayaran</label>
                        <select name="status" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border bg-white">
                            <option value="draft">Draft (Belum Dibayar)</option>
                            <option value="paid" selected>Paid (Sudah Dibayar)</option>
                        </select>
                    </div>
                </div>

                {{-- Column 2: Financials --}}
                <div class="space-y-4">
                    <h3 class="font-bold text-gray-700 border-b pb-2">Rincian Gaji (Rupiah)</h3>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Gaji Pokok</label>
                        <input type="number" name="salary" x-model.number="salary" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border bg-gray-50" required>
                    </div>
                    
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tunjangan / Bonus (+)</label>
                        <input type="number" name="bonus" x-model.number="bonus" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border" placeholder="0">
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Potongan (-)</label>
                        <input type="number" name="deduction" x-model.number="deduction" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border" placeholder="0">
                    </div>

                    <div class="bg-blue-50 p-3 border border-blue-200 mt-4">
                        <label class="block text-blue-900 text-sm font-bold mb-1">Total Gaji Bersih (Take Home Pay)</label>
                        <div class="text-2xl font-bold text-blue-800" x-text="formatRupiah(netSalary)">Rp 0</div>
                        <input type="hidden" name="net_salary" :value="netSalary">
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Catatan Tambahan (Opsional)</label>
                <textarea name="notes" rows="2" class="w-full border px-3 py-2 text-sm focus:outline-none focus:border-blue-500 win-border" placeholder="Contoh: Bonus Project Alpha"></textarea>
            </div>

            <div class="flex justify-end gap-2 pt-4 border-t">
                <a href="{{ route('salary-slips.index') }}" class="bg-gray-500 text-white px-4 py-2 win-border text-sm hover:bg-gray-600">
                    Batal
                </a>
                <button type="submit" class="bg-blue-700 text-white px-6 py-2 win-border text-sm hover:bg-blue-800 font-bold">
                    💾 Simpan & Generate Slip
                </button>
            </div>
        </form>

    </div>

    {{-- Script untuk auto-fill salary dan kalkulasi --}}
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('salaryCalculator', () => ({
                salary: 0,
                bonus: 0,
                deduction: 0,
                
                get netSalary() {
                    return (this.salary || 0) + (this.bonus || 0) - (this.deduction || 0);
                },

                updateSalary(selectElement) {
                    const selectedOption = selectElement.options[selectElement.selectedIndex];
                    const baseSalary = selectedOption.getAttribute('data-salary');
                    this.salary = baseSalary ? parseFloat(baseSalary) : 0;
                },

                formatRupiah(number) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
                }
            }))
        })
    </script>
@endsection
