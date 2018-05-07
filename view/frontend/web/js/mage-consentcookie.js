/*
 *    Copyright 2018 Humanswitch
 *
 *    Licensed under the Apache License, Version 2.0 (the "License");
 *    you may not use this file except in compliance with the License.
 *    You may obtain a copy of the License at
 *
 *        http://www.apache.org/licenses/LICENSE-2.0
 *
 *    Unless required by applicable law or agreed to in writing, software
 *    distributed under the License is distributed on an "AS IS" BASIS,
 *    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *    See the License for the specific language governing permissions and
 *    limitations under the License.
 */
/* jscs:disable */
/* eslint-disable */
define([
    'jquery',
    'ConsentCookie'
], function ($, ConsentCookie) {
    'use strict';

    /**
     * @param {Object} config
     */
    return function (config) {

        window.ConsentCookie = ConsentCookie;
        window.ConsentCookie.init(config);

        console.log('init called');

        // Create event to dispatch on init
        var CCInitEvent = new CustomEvent('CCInit', {
            detail: {
                ConsentCookie: ConsentCookie,
            }
        });

        window.ConsentCookie.on('connection', function (e) {
            console.log(e);

            // if((e.id === 'ga' && e.state==='enabled') && (!window._gaq || !window._gaq._getTracker)){
            //     console.log('enable GA');
            // }
            // if (window._gaq && window._gaq._getTracker) {
            //     console.log('analytics is loaded');
            // } else {
            //     console.log('analytics is not loaded');
            // }

            console.log(e.id);
            console.log(e.state);

            if(e.id == 'ga' && e.state == 'enabled'){
                console.log('dispatching GA');
                window.dispatchEvent(CCInitEvent);
            }
        });

        // Dispatch init event
        window.dispatchEvent(CCInitEvent);
    }
});
