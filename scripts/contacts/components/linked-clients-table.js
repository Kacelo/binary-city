
function renderClientsTable(clients, contactId) {
    const tableContainer = document.getElementById("contacts_table_container");
    // Clear previous content
    tableContainer.innerHTML = "";

    if (clients.length > 0) {
        // Create table element
        const table = document.createElement("table");
        table.className = "table table-bordered";

        // Create table header
        const thead = document.createElement("thead");
        thead.innerHTML = `
        <tr>
            <th>Client Name</th>
            <th>Client Code</th>
            <th></th>
        </tr>
    `;
        table.appendChild(thead);

        // Create table body
        const tbody = document.createElement("tbody");
        clients.forEach(client => {
            const row = document.createElement("tr");
            row.innerHTML = `
            <td>${client.client_name}</td>
            <td>${client.client_code}</td>
            <td><a onclick="return ConfirmDelete(${client.client_id},${contactId.value});" class="" id="unlinkClient">Unlink Client</a></td>
        `;
            tbody.appendChild(row);
        });

        table.appendChild(tbody);
        tableContainer.appendChild(table); // Append table to the container
    } else {
        tableContainer.innerHTML = "<p>No clients found.</p>";
    }
}

