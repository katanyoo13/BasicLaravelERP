@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Journal Entries</h1>
    <a href="{{ route('journals.create') }}" class="btn btn-success mb-3">Add New Journal Entry</a>
    <table class="table">
        <thead>
            <tr>
                <th>Journal ID</th>
                <th>Entry Date</th>
                <th>Description</th>
                <th>Total Debit</th>
                <th>Total Credit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journals as $journal)
            <tr>
                <td>{{ $journal->journal_id }}</td>
                <td>{{ $journal->entry_date }}</td>
                <td>{{ $journal->description }}</td>
                <td>{{ $journal->total_debit }}</td>
                <td>{{ $journal->total_credit }}</td>
                <td>
                    <a href="{{ route('journals.edit', $journal->journal_id) }}" class="btn btn-primary action-btn">Edit</a>
                    <form action="{{ route('journals.destroy', $journal->journal_id) }}" method="POST" style="display:inline-block;">
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
