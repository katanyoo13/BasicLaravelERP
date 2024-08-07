export function editLedgerAccount(id) {
    console.log("editLedgerAccount function called with ID:", id);
    fetch(`/ledger_accounts/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('edit_ledger_id').value = data.ledgerAccount.id;
                document.getElementById('edit_account_number').value = data.ledgerAccount.account_number;
                document.getElementById('edit_account_name').value = data.ledgerAccount.account_name;
                document.getElementById('edit_account_type').value = data.ledgerAccount.account_type;
                document.getElementById('edit_balance').value = data.ledgerAccount.balance;
                $('#editLedgerAccountModal').modal('show');
            }
        })
        .catch(error => {
            console.error('Error fetching ledger account data:', error);
        });
}

export function deleteLedgerAccount(id) {
    console.log("deleteLedgerAccount function called with ID:", id);
    fetch(`/ledger_accounts/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            var row = document.querySelector(`tr[data-id='${id}']`);
            row.remove();
        } else {
            console.log(data.errors);
        }
    })
    .catch(error => console.error('Error:', error));
}
