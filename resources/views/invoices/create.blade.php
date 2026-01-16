@extends('layouts.dashboard')

@section('title', 'Buat Invoice Baru')

@section('content')
    <div class="max-w-5xl mx-auto">
        {{-- Header Navigation --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-blue-900 text-lg">➕ Buat Invoice Baru</h2>
            <a href="{{ route('invoices.index') }}" class="text-sm text-blue-700 underline">← Kembali</a>
        </div>

        <form action="{{ route('invoices.store') }}" method="POST" id="invoiceForm" class="bg-white p-4 win-border">
            @csrf

            {{-- Grid Input Utama --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                {{-- Nomor Invoice --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Nomor Invoice <span class="text-red-500">*</span></label>
                    <input type="text" name="invoice_number" value="{{ old('invoice_number', $invoiceNumber) }}"
                        class="w-full border px-2 py-1 bg-gray-50 focus:outline-none focus:border-blue-500" required>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Status</label>
                    <select name="status"
                        class="w-full border px-2 py-1 bg-white focus:outline-none focus:border-blue-500">
                        <option value="draft">Draft</option>
                        <option value="sent">Sent</option>
                        <option value="paid">Paid</option>
                    </select>
                </div>

                {{-- Client --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Client <span class="text-red-500">*</span></label>
                    <select name="client_id"
                        class="w-full border px-2 py-1 bg-white focus:outline-none focus:border-blue-500" required>
                        <option value="">-- Pilih Client --</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->company_name }} - {{ $client->contact_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Project --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Project <span class="text-red-500">*</span></label>
                    <select name="project_id"
                        class="w-full border px-2 py-1 bg-white focus:outline-none focus:border-blue-500" required>
                        <option value="">-- Pilih Project --</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Terbit --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Tanggal Terbit <span class="text-red-500">*</span></label>
                    <input type="date" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}"
                        class="w-full border px-2 py-1 bg-gray-50 focus:outline-none focus:border-blue-500" required>
                </div>

                {{-- Jatuh Tempo --}}
                <div>
                    <label class="block text-sm font-bold mb-1">Jatuh Tempo <span class="text-red-500">*</span></label>
                    <input type="date" name="due_date"
                        value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}"
                        class="w-full border px-2 py-1 bg-gray-50 focus:outline-none focus:border-blue-500" required>
                </div>
            </div>

            <hr class="border-gray-300 mb-4">

            {{-- Invoice Items Table --}}
            <h3 class="font-bold text-blue-900 mb-2">📋 Item Invoice</h3>
            <div class="overflow-x-auto">
                <table class="w-full border border-collapse mb-4 text-sm" id="itemsTable">
                    <thead class="bg-blue-200 text-blue-900">
                        <tr>
                            <th class="border px-2 py-1 text-left w-1/2">Deskripsi</th>
                            <th class="border px-2 py-1 text-center w-24">Qty</th>
                            <th class="border px-2 py-1 text-right">Harga Satuan (Rp)</th>
                            <th class="border px-2 py-1 text-right">Total (Rp)</th>
                            <th class="border px-2 py-1 w-12 text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Default 1 row --}}
                        <tr class="item-row hover:bg-yellow-50">
                            <td class="border px-2 py-1">
                                <input type="text" name="items[0][description]"
                                    class="w-full border px-2 py-1 focus:outline-none focus:border-blue-500" required>
                            </td>
                            <td class="border px-2 py-1">
                                <input type="number" name="items[0][qty]"
                                    class="w-full border px-2 py-1 text-center qty-input focus:outline-none focus:border-blue-500"
                                    min="1" value="1" required oninput="calculateRow(this)">
                            </td>
                            <td class="border px-2 py-1">
                                <input type="number" name="items[0][price]"
                                    class="w-full border px-2 py-1 text-right price-input focus:outline-none focus:border-blue-500"
                                    min="0" value="0" required oninput="calculateRow(this)">
                            </td>
                            <td class="border px-2 py-1 text-right bg-gray-50 font-mono total-display">0</td>
                            <td class="border px-2 py-1 text-center">
                                <button type="button" class="text-red-500 hover:text-red-700 font-bold"
                                    onclick="removeRow(this)">🗑️</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot class="bg-gray-100">
                        <tr>
                            <td colspan="3" class="border px-2 py-1 text-right font-bold text-blue-900">Subtotal</td>
                            <td class="border px-2 py-1 text-right font-bold font-mono" id="grandTotal">0</td>
                            <td class="border bg-white"></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="border px-2 py-1 text-right font-bold text-blue-900">Pajak (%)</td>
                            <td class="border px-2 py-1">
                                <input type="number" name="tax_rate" id="taxRate"
                                    class="w-full text-right border px-2 py-1 focus:outline-none focus:border-blue-500"
                                    min="0" max="100" step="0.5" value="0" oninput="calculateGrandTotal()">
                            </td>
                            <td class="border px-2 py-1 text-right text-red-600 font-mono" id="taxAmount">0</td>
                            <td class="border bg-white"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- Tombol Aksi Bawah --}}
            <div class="flex justify-between items-center mt-5 pt-3 border-t">
                <button type="button" class="bg-green-700 text-white px-3 py-1 win-border hover:bg-green-600 text-sm"
                    onclick="addItem()">
                    ➕ Tambah Item
                </button>

                <div class="flex gap-2">
                    <a href="{{ route('invoices.index') }}"
                        class="bg-gray-500 text-white px-4 py-1 win-border hover:bg-gray-600 text-sm">
                        Batal
                    </a>
                    <button type="submit" class="bg-blue-700 text-white px-4 py-1 win-border hover:bg-blue-600 text-sm">
                        💾 Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Script untuk kalkulasi dan tambah baris --}}
    <script>
        let itemIndex = 1;

        function addItem() {
            const table = document.getElementById('itemsTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.className = 'item-row hover:bg-yellow-50';
            newRow.innerHTML = `
            <td class="border px-2 py-1">
                <input type="text" name="items[${itemIndex}][description]" class="w-full border px-2 py-1 focus:outline-none focus:border-blue-500" required>
            </td>
            <td class="border px-2 py-1">
                <input type="number" name="items[${itemIndex}][qty]" class="w-full border px-2 py-1 text-center qty-input focus:outline-none focus:border-blue-500" min="1" value="1" required oninput="calculateRow(this)">
            </td>
            <td class="border px-2 py-1">
                <input type="number" name="items[${itemIndex}][price]" class="w-full border px-2 py-1 text-right price-input focus:outline-none focus:border-blue-500" min="0" value="0" required oninput="calculateRow(this)">
            </td>
            <td class="border px-2 py-1 text-right bg-gray-50 font-mono total-display">0</td>
            <td class="border px-2 py-1 text-center">
                <button type="button" class="text-red-500 hover:text-red-700 font-bold" onclick="removeRow(this)">🗑️</button>
            </td>
        `;
            itemIndex++;
        }

        function removeRow(btn) {
            const row = btn.parentNode.parentNode;
            if (document.querySelectorAll('.item-row').length > 1) {
                row.parentNode.removeChild(row);
                calculateGrandTotal();
            }
        }

        function calculateRow(input) {
            const row = input.closest('tr');
            const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
            const price = parseFloat(row.querySelector('.price-input').value) || 0;
            const total = qty * price;

            row.querySelector('.total-display').innerText = total.toLocaleString('id-ID');
            calculateGrandTotal();
        }



        function calculateGrandTotal() {
            let subtotal = 0;
            document.querySelectorAll('.item-row').forEach(row => {
                const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
                const price = parseFloat(row.querySelector('.price-input').value) || 0;
                subtotal += (qty * price);
            });

            const taxRate = parseFloat(document.getElementById('taxRate').value) || 0;
            const taxAmount = subtotal * (taxRate / 100);
            const total = subtotal + taxAmount;

            document.getElementById('taxAmount').innerText = taxAmount.toLocaleString('id-ID');
            document.getElementById('grandTotal').innerText = total.toLocaleString('id-ID');
        }
    </script>
@endsection
