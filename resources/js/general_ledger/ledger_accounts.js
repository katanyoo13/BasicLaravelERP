//ADD
document.addEventListener('DOMContentLoaded', function () {
    // Check if Add Ledger Account Button exists before adding event listener
    const addLedgerAccountBtn = document.getElementById('addLedgerAccountBtn');
    if (addLedgerAccountBtn) {
        addLedgerAccountBtn.addEventListener('click', function () {
            $('#addLedgerAccountModal').modal('show');
        });
    }

    // Check if Add Ledger Account Form exists
    const addLedgerAccountForm = document.getElementById('addLedgerAccountForm');
    if (addLedgerAccountForm) {
        $(document).ready(function() {
            $('#addLedgerAccountForm').on('submit', function(e) {
                e.preventDefault();
                
                let formData = {
                    _token: $('input[name="_token"]').val(),
                    account_number: $('#account_number').val(),
                    account_name: $('#account_name').val(),
                    account_type: $('#account_type').val(),
                    balance: $('#balance').val()
                };
        
                $.ajax({
                    type: 'POST',
                    url: '/ledger_accounts',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            $('#addLedgerAccountModal').modal('hide');
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
        });
    }

    // Check if Edit Buttons exist before adding event listeners
    const editButtons = document.querySelectorAll('.editBtn');
    if (editButtons.length > 0) {
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const ledgerId = this.getAttribute('data-id');
                $('#editLedgerAccountModal').modal('show');
            });
        });
    }

    // Handle Edit Ledger Account
    document.querySelectorAll('.editBtn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/ledger-accounts/${id}/edit`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('edit_ledger_id').value = data.ledger_id;
                    document.getElementById('edit_account_number').value = data.account_number;
                    document.getElementById('edit_account_name').value = data.account_name;
                    document.getElementById('edit_account_type').value = data.account_type;
                    document.getElementById('edit_balance').value = data.balance;
                    $('#editLedgerAccountModal').modal('show');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to fetch ledger account details.');
                });
        });
    });

    const editLedgerAccountForm = document.getElementById('editLedgerAccountForm');
    if (editLedgerAccountForm) {
        editLedgerAccountForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const id = document.getElementById('edit_ledger_id').value;
            const formData = new FormData(this);

            fetch(`/ledger-accounts/${id}`, {
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
                    alert('Failed to update ledger account');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Delete Ledger Account
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const ledgerId = this.getAttribute('data-id');
            
            if (confirm('Are you sure you want to delete this ledger account?')) {
                fetch(`/ledger_accounts/${ledgerId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the deleted row from the table
                        document.querySelector(`tr[data-id="${ledgerId}"]`).remove();
                    } else {
                        alert('Error deleting ledger account: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});