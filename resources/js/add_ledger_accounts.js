export function addLedgerAccount() {
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
                // Hide modal
                $('#addLedgerAccountModal').modal('hide');
                // Append new data to the table
                var newRow = `<tr data-id="${data.ledgerAccount.id}">
                    <td>${data.ledgerAccount.account_number}</td>
                    <td>${data.ledgerAccount.account_name}</td>
                    <td>${data.ledgerAccount.account_type}</td>
                    <td>${data.ledgerAccount.balance}</td>
                    <td class="action-buttons">
                        <button class="btn btn-edit action-btn" data-id="${data.ledgerAccount.id}" onclick="editLedgerAccount(${data.ledgerAccount.id})">Edit</button>
                        <button class="btn btn-delete action-btn" data-id="${data.ledgerAccount.id}" onclick="deleteLedgerAccount(${data.ledgerAccount.id})">Delete</button>
                    </td>
                </tr>`;
                document.querySelector('table tbody').insertAdjacentHTML('beforeend', newRow);
                // Reinitialize edit and delete buttons
                addEditListeners();
                addDeleteListeners();
            } else {
                // Handle validation errors
                console.error("Error adding ledger account:", data.errors);
            }
        })
        .catch(error => console.error('Error adding ledger account:', error));
    });
}

function addEditListeners() {
    document.querySelectorAll('.btn-edit').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            editLedgerAccount(id);
        });
    });
}

function addDeleteListeners() {
    document.querySelectorAll('.btn-delete').forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            deleteLedgerAccount(id);
        });
    });
}

// Initial call to add event listeners
addEditListeners();
addDeleteListeners();
