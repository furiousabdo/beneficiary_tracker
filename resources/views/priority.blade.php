@extends('layouts.app')
@section('title', 'Beneficiary Priority List')
@section('content')
    <h1>Beneficiary Priority List</h1>
    <table border="1" cellpadding="10" style="width:100%; margin-top:2rem;">
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
                        <ul>
                        @foreach($family->beneficiaries as $beneficiary)
                            <li>
                                <strong>{{ $beneficiary->name }}</strong>
                                <ul>
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
@endsection 