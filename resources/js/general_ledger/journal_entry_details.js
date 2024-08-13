document.addEventListener('DOMContentLoaded', function () {
    // Check if Add Journal Entry Detail Button exists before adding event listener
    const addJournalEntryDetailBtn = document.getElementById('addJournalEntryDetailBtn');
    if (addJournalEntryDetailBtn) {
        addJournalEntryDetailBtn.addEventListener('click', function () {
            $('#addJournalEntryDetailModal').modal('show');
        });
    }

    // Check if Add Journal Entry Detail Form exists
    const addJournalEntryDetailForm = document.getElementById('addJournalEntryDetailForm');
    if (addJournalEntryDetailForm) {
        $('#addJournalEntryDetailForm').on('submit', function(e) {
            e.preventDefault();
            
            let formData = {
                _token: $('input[name="_token"]').val(),
                journal_id: $('#journal_id').val(),
                account_number: $('#account_number').val(),
                debit: $('#debit').val(),
                credit: $('#credit').val(),
                description: $('#description').val()
            };
    
            $.ajax({
                type: 'POST',
                url: '/journal_entry_details',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#addJournalEntryDetailModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(response) {
                    console.log('Error:', response);
                    alert('An error occurred. Please try again.');
                }
            });
        });
    }

    // Handle Edit Journal Entry Detail
    document.querySelectorAll('.editJournalEntryDetailBtn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/journal_entry_details/${id}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('edit_detail_id').value = data.detail_id;
                    document.getElementById('edit_journal_id').value = data.journal_id;
                    document.getElementById('edit_account_number').value = data.account_number;
                    document.getElementById('edit_debit').value = data.debit;
                    document.getElementById('edit_credit').value = data.credit;
                    document.getElementById('edit_description').value = data.description;
                    $('#editJournalEntryDetailModal').modal('show');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to fetch journal entry detail.');
                });
        });
    });

    const editJournalEntryDetailForm = document.getElementById('editJournalEntryDetailForm');
    if (editJournalEntryDetailForm) {
        editJournalEntryDetailForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('edit_detail_id').value;
            const formData = new FormData(this);

            fetch(`/journal_entry_details/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    $('#editJournalEntryDetailModal').modal('hide');
                    location.reload();
                } else {
                    alert('Failed to update journal entry detail');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Delete Journal Entry Detail
    document.querySelectorAll('.deleteJournalDetailsBtn').forEach(button => {
        button.addEventListener('click', function() {
            const detailId = this.getAttribute('data-id');
            
            if (confirm('Are you sure you want to delete this journal entry detail?')) {
                fetch(`/journal_entry_details/${detailId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the deleted row from the table
                        document.querySelector(`tr[data-id="${detailId}"]`).remove();
                    } else {
                        alert('Error deleting journal entry detail: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
