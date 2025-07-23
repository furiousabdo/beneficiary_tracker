@extends('layouts.app')
@section('title', 'Beneficiary Priority List')
@section('content')
<div class="card">
    <h1 style="font-size:1.5rem;font-weight:600;margin-bottom:1.5rem;">Beneficiary Priority List</h1>
    <table>
        <thead>
            <tr>
                <th>Family Name</th>
                <th>Total Aid Received</th>
                <th>Beneficiaries</th>
            </tr>
        </thead>
        <tbody>
            @foreach($families as $family)
                <tr>
                    <td>{{ $family->family_name ?? 'N/A' }}</td>
                    <td>${{ number_format($family->totalAid(), 2) }}</td>
                    <td>
                        <ul style="margin:0;padding-left:1.2rem;">
                        @foreach($family->beneficiaries as $beneficiary)
                            <li style="margin-bottom:0.5rem;">
                                <strong>{{ $beneficiary->name }}</strong>
                                <ul style="margin:0.2rem 0 0 1.2rem;">
                                    @foreach($beneficiary->aidRecords as $aid)
                                        <li>{{ $aid->aid_type }}: ${{ number_format($aid->amount, 2) }} ({{ $aid->date_given }})</li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 