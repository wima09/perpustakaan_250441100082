@extends('layouts.app')
@section('title', 'Detail Peminjaman')
@section('content')
    <div class="space-y-6">
        <div class="border-b border-gray-200 pb-4">
            <h1 class="text-2xl font-semibold text-gray-800">
                Detail Peminjaman #{{ $peminjaman->id }}
            </h1>
        </div>

        <div class="bg-white border border-gray-200 overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <tbody class="divide-y divide-gray-200">
                    @foreach ($peminjaman->getAttributes() as $kolom => $nilai)
                        <tr>
                            <th class="px-5 py-3 font-semibold text-gray-700">{{ $kolom }}</th>
                            <td class="px-5 py-3">{{ $nilai ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection