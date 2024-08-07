// ledger_accounts.js
import { editLedgerAccount, deleteLedgerAccount } from './edit_ledger_accounts';
import { addLedgerAccount } from './add_ledger_accounts';

document.addEventListener("DOMContentLoaded", function() {
    var addLedgerAccountBtn = document.getElementById("addLedgerAccountBtn");
    var addLedgerAccountModal = document.getElementById("addLedgerAccountModal");
    var addLedgerAccountForm = document.getElementById("addLedgerAccountForm");

    // Show modal when button is clicked
    addLedgerAccountBtn.addEventListener("click", function() {
        $('#addLedgerAccountModal').modal('show');
    });

    // Handle form submission with AJAX for adding
    addLedgerAccountForm.addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(addLedgerAccountForm);

        fetch('/ledger_accounts', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#addLedgerAccountModal').modal('hide');
                var newRow = `<tr data-id="${data.ledgerAccount.id}">
                    <td>${data.ledgerAccount.account_number}</td>
                    <td>${data.ledgerAccount.account_name}</td>
                    <td>${data.ledgerAccount.account_type}</td>
                    <td>${data.ledgerAccount.balance}</td>
                    <td class="action-buttons">
                        <button class="btn btn-edit action-btn" data-id="${data.ledgerAccount.id}">Edit</button>
                        <button class="btn btn-delete action-btn" data-id="${data.ledgerAccount.id}">Delete</button>
                    </td>
                </tr>`;
                document.querySelector('table tbody').insertAdjacentHTML('beforeend', newRow);
                addEditListeners();
                addDeleteListeners();
            } else {
                console.log(data.errors);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    function addEditListeners() {
        document.querySelectorAll('.btn-edit').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                console.log("Edit button clicked with ID:", id);
                editLedgerAccount(id);
            });
        });
    }

    function addDeleteListeners() {
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                console.log("Delete button clicked with ID:", id);
                deleteLedgerAccount(id);
            });
        });
    }

    addEditListeners();
    addDeleteListeners();
});
