@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Journal Entry Details</h1>
    <a href="{{ route('journal_entry_details.create') }}" class="btn btn-success mb-3">Add New Journal Entry Detail</a>
    <table class="table">
        <thead>
            <tr>
                <th>Journal ID</th>
                <th>Account Number</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journalEntryDetails as $detail)
            <tr>
                <td>{{ $detail->journal_id }}</td>
                <td>{{ $detail->account_number }}</td>
                <td>{{ $detail->debit }}</td>
                <td>{{ $detail->credit }}</td>
                <td>{{ $detail->description }}</td>
                <td>
                    <a href="{{ route('journal_entry_details.edit', $detail->detail_id) }}" class="btn btn-primary action-btn">Edit</a>
                    <form action="{{ route('journal_entry_details.destroy', $detail->detail_id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger action-btn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
