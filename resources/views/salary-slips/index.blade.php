@extends('layouts.dashboard')

@section('title', 'Slip Gaji Karyawan')

@section('content')
    <div class="h-full flex flex-col">

        {{-- Info Box --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-900 px-4 py-3 mb-4 text-sm">
            <h4 class="font-bold mb-1">ℹ️ Manajemen Slip Gaji</h4>
            <p>Kelola dan cetak slip gaji karyawan untuk periode tertentu. Pastikan data gaji sudah sesuai sebelum dicetak.</p>
        </div>

        <div class="flex items-center justify-between mb-4">
            {{-- Filter Form --}}
            <form method="GET" action="{{ route('salary-slips.index') }}" class="flex gap-2 items-center">
                <select name="month" class="border px-2 py-1 text-sm rounded bg-white win-border" onchange="this.form.submit()">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>
                <select name="year" class="border px-2 py-1 text-sm rounded bg-white win-border" onchange="this.form.submit()">
                    @foreach(range(date('Y')-2, date('Y')+1) as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </form>

            <a href="{{ route('salary-slips.create') }}" class="bg-blue-700 text-white px-3 py-1 win-border hover:bg-blue-800">
                ➕ Buat Slip Gaji
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex-1 overflow-auto win-border bg-white">
            <table class="w-full text-sm border-collapse">
                <thead class="bg-gray-100 border-b-2 border-gray-300 sticky top-0">
                    <tr>
                        <th class="border px-2 py-1 text-center w-12">No</th>
                        <th class="border px-2 py-1 text-left">No. Slip</th>
                        <th class="border px-2 py-1 text-left">Karyawan</th>
                        <th class="border px-2 py-1 text-center">Periode</th>
                        <th class="border px-2 py-1 text-right">Gaji Bersih (Receive)</th>
                        <th class="border px-2 py-1 text-center">Status</th>
                        <th class="border px-2 py-1 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($slips as $index => $slip)
                        <tr class="hover:bg-blue-50 border-b border-gray-100">
                            <td class="border px-2 py-1 text-center">{{ $slips->firstItem() + $index }}</td>
                            <td class="border px-2 py-1 font-mono text-xs">{{ $slip->slip_number }}</td>
                            <td class="border px-2 py-1 font-semibold">
                                {{ $slip->employee->full_name }}
                                <div class="text-xs text-gray-500 font-normal">{{ $slip->employee->position }}</div>
                            </td>
                            <td class="border px-2 py-1 text-center">
                                {{ DateTime::createFromFormat('!m', $slip->period_month)->format('M') }} {{ $slip->period_year }}
                            </td>
                            <td class="border px-2 py-1 text-right font-mono font-bold text-green-700">
                                Rp {{ number_format($slip->net_salary, 0, ',', '.') }}
                            </td>
                            <td class="border px-2 py-1 text-center">
                                @if($slip->status == 'paid')
                                    <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded border border-green-400">PAID</span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded border border-gray-400">DRAFT</span>
                                @endif
                            </td>
                            <td class="border px-2 py-1 text-center">
                                <div class="flex justify-center gap-1">
                                    <a href="{{ route('salary-slips.show', $slip->id) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 border border-gray-300 px-2 py-0.5 rounded text-xs" title="Cetak / Lihat" target="_blank">
                                        🖨️
                                    </a>
                                    <form action="{{ route('salary-slips.destroy', $slip->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus slip gaji ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 px-1" title="Hapus">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="border px-2 py-8 text-center text-gray-500 italic">
                                Belum ada data slip gaji untuk periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
             {{ $slips->appends(['month' => $month, 'year' => $year])->links() }}
        </div>
    </div>
@endsection
