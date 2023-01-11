(function() {

    var db = {

        loadData: function(filter) {
            return $.grep(this.clients, function(client) {
                return (!filter.Subject || client.Subject.indexOf(filter.Subject) > -1)
                    && (!filter.By || client.By.indexOf(filter.By) > -1)
                    && (!filter.Agent || client.Agent.indexOf(filter.Agent) > -1)
                    && (filter.Status === undefined || client.Status === filter.Status);
            });
        },

        insertItem: function(insertingClient) {
            this.clients.push(insertingClient);
        },

        updateItem: function(updatingClient) { },

        deleteItem: function(deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1);
        }

    };

    window.db = db;


    db.clients = [
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "",
            "Status": false
        },
        {
            "Subject": "Website is down",
            "By": "user name 2",
            "Agent": "",
            "Status": false
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "Agent name 1",
            "Status": true
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "",
            "Status": false
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "Agent name 1",
            "Status": true
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "Agent name 1",
            "Status": true
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "",
            "Status": false
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "",
            "Status": false
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "Agent name 1",
            "Status": true
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "",
            "Status": false
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "",
            "Status": false
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "",
            "Status": false
        },
        {
            "Subject": "this is the subject of ticket",
            "By": "user name 1",
            "Agent": "",
            "Status": false
        },
        
    ];

}());