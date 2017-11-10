(function(app){
    app.events.on("router:init", function(){
        var routes = [
            {
                route: 'dialogue1_amity',
                name: 'testDoSomething',
                callback: function(){
                    app.controller.loadView({
                        layout: "create",
                        create: true,
                        module: 'dialogue1_amity'
                    });
                }
            }
        ];

        app.router.addRoutes(routes);
    });

    app.events.on('app:sync:complete', function() {
        redirectToEditAmity();

        window.onhashchange = redirectToEditAmity;

        function redirectToEditAmity() {

            if (isAmityModule()) {
                getAmityConnectionId();
            }

            function isAmityModule() {
                return getModuleName().indexOf('dialogue1_amity') >= 0;

                function getModuleName() {
                    var urlParts = window.location.href.split('/');

                    return urlParts[urlParts.length - 1]
                }
            }

            function getAmityConnectionId() {
                app.api.call(
                    'read',
                    app.api.buildURL('dialogue1_amity'),
                    null,
                    {
                        success: routeToEditAmityIfConnectionExists,
                        error: logError
                    }
                );

                function routeToEditAmityIfConnectionExists(response) {
                    if (response['records'].length > 0) {
                        window.location = window.location.href + '/' + response['records'][0]['id'];
                    }
                }

                function logError(e) {
                    console.log(e);
                }
            }
        }
    });

})(SUGAR.App);