// Handle Add Journal Entry
document.addEventListener('DOMContentLoaded', function () {
    // Check if Add Journal Entry Button exists before adding event listener
    const addJournalEntryBtn = document.getElementById('addJournalEntryBtn');
    if (addJournalEntryBtn) {
        addJournalEntryBtn.addEventListener('click', function () {
            $('#addJournalEntryModal').modal('show');
        });
    }

    // Check if Add Journal Entry Form exists
    const addJournalEntryForm = document.getElementById('addJournalEntryForm');
    if (addJournalEntryForm) {
        $('#addJournalEntryForm').on('submit', function(e) {
            e.preventDefault();
            
            let formData = {
                _token: $('input[name="_token"]').val(),
                entry_date: $('#entry_date').val(),
                description: $('#description').val(),
                total_debit: $('#total_debit').val(),
                total_credit: $('#total_credit').val()
            };
    
            $.ajax({
                type: 'POST',
                url: '/journals',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#addJournalEntryModal').modal('hide');
                        location.reload(); // or update the table dynamically
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

    // Check if Edit Buttons exist before adding event listeners
    const editButtons = document.querySelectorAll('.editJournalBtn');
    if (editButtons.length > 0) {
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const journalId = this.getAttribute('data-id');
                $('#editJournalEntryModal').modal('show');
            });
        });
    }

    // Handle Edit Journal Entry
    document.querySelectorAll('.editJournalBtn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/journals/${id}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('edit_journal_id').value = data.journal_id;
                    document.getElementById('edit_entry_date').value = data.entry_date;
                    document.getElementById('edit_description').value = data.description;
                    document.getElementById('edit_total_debit').value = data.total_debit;
                    document.getElementById('edit_total_credit').value = data.total_credit;
                    $('#editJournalEntryModal').modal('show');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to fetch journal entry details.');
                });
        });
    });

    const editJournalEntryForm = document.getElementById('editJournalEntryForm');
    if (editJournalEntryForm) {
        editJournalEntryForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('edit_journal_id').value;
            const formData = new FormData(this);

            fetch(`/journals/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                } else {
                    alert('Failed to update journal entry');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Delete Journal Entry
    document.querySelectorAll('.deleteJournalBtn').forEach(button => {
        button.addEventListener('click', function() {
            const journalId = this.getAttribute('data-id');
            
            if (confirm('Are you sure you want to delete this journal entry?')) {
                fetch(`/journals/${journalId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the deleted row from the table
                        document.querySelector(`tr[data-id="${journalId}"]`).remove();
                    } else {
                        alert('Error deleting journal entry: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
