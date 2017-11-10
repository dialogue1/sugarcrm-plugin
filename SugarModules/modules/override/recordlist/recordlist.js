/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */
({
    extendsFrom: 'RecordlistView',

    /**
     * @inheritdoc
     *
     * Add amity plugin for view.
     */
    initialize: function(options) {
        this._super('initialize', [options]);

        //add listener for custom button
        this.context.on('button:export_to_amity:click', this.export_to_amity, this);
    },

    export_to_amity: function(event) {
        var module = this.module;
        app.alert.show('amity-export', {
            level: 'confirmation',
            messages: app.lang.get('LBL_EXPORT_TO_AMITY_CONFIRMATION', 'ProspectLists'),
            onConfirm: function () {
                $('a').css({'pointer-events': 'none'});
                $('#alerts').append(getLoaderTemplate());
                App.api.call(
                    'create',
                    App.api.buildURL('ExportToAmityApi/export'),
                    {module: module, listId: event.id, listName: event._syncedAttributes.name},
                    {
                        success: handleSuccessfulExportToAmity,
                        error: handleFailedExportToAmity
                    }
                );

                function getLoaderTemplate() {
                    return '<div class="alerts-wrapper">' +
                        '<div class="alert alert-process">' +
                        '<strong>' +
                        '<div class="loading">Loading<i class="l1">.</i><i class="l2">.</i><i class="l3">.</i>' +
                        '</div>' +
                        '</strong>' +
                        '</div>' +
                        '</div>';
                }

                function handleSuccessfulExportToAmity() {
                    unblockElementsAndHideLoading();
                    app.alert.show('success', {
                        level: 'success',
                        autoClose: true,
                        autoCloseDelay: 10000,
                        messages: app.lang.get('LBL_SUCCESS_EXPORT_TO_AMITY', 'ProspectLists')
                    });
                }

                function handleFailedExportToAmity(e) {
                    unblockElementsAndHideLoading();
                    app.alert.show('server-error', {
                        level: 'error',
                        messages: app.lang.get('LBL_FAIL_EXPORT_TO_AMITY', 'ProspectLists'),
                        autoClose: true,
                        autoCloseDelay: 10000
                    });
                    throw e;
                }

                function unblockElementsAndHideLoading() {
                    $('a').css({'pointer-events': ''});
                    $('#alerts').children().hide();
                }

            },
            autoClose: false
        });
    }
})
