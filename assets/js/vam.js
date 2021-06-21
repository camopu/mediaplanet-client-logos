window.addEventListener('DOMContentLoaded', (event) => {
    window._gam = {
        slots: {},
        initAd: function initAd(element)
        {
            if (element instanceof jQuery && typeof element.attr('data-ad-unit-path') !== "undefined" && element.attr('data-ad-unit-path') !== false) {
                var self = this;
                var slot = element.data('ad-unit-path'),
                    sizes = element.data('ad-sizes'),
                    elementID = element.attr('id');
                googletag.cmd.push(function () {
                    self.slots[elementID] = googletag.defineSlot(slot, sizes, elementID)
                        .addService(googletag.pubads());
                    if (typeof window.vamShowDefaultTargeting !== "undefined" && window.vamShowDefaultTargeting) {
                        if (typeof element.data('default-tag-name') !== "undefined") {
                            //Check if ad on category page than need set category ID
                            if (jQuery('body').hasClass('archive') || jQuery('body').hasClass('category')) {
                                self.slots[elementID].setTargeting(element.data('default-tag-name'), element.data('category-id'));
                            } else {
                                // If not a category page than set article ID
                                self.slots[elementID].setTargeting(element.data('default-tag-name'), element.closest('article').data('vicky-this'));
                            }
                        }
                    }
                    if (element.find('input[type=hidden]').length > 0) {
                        jQuery.each(element.find('input[type=hidden]'), function (index, target) {
                                self.slots[elementID].setTargeting(jQuery(target).attr('name'), jQuery(target).val());
                        });
                    }
                    googletag.pubads().collapseEmptyDivs();
                    googletag.pubads().setTargeting('domain', window.location.host);
                    googletag.enableServices();
                    googletag.pubads().enableSingleRequest();
                    googletag.display(elementID);
                });
            }
        }
    };
    var isGoogletagReady = setInterval(function () {
        if (window.googletag && window.googletag.apiReady) {
            clearInterval(isGoogletagReady);
            jQuery.each(jQuery('.ad-container > div'), function (index, adPlaceholder) {
                if (jQuery(adPlaceholder).data('google-query-id') === undefined) {
                    //Ad is not initialized
                    window._gam.initAd(jQuery(adPlaceholder))
                }
            });
        }
    }, 1000);
});