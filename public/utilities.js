
var utilities = {};

utilities.loadingStateHtml = '<div class="loading-overlay overlay"><i class="fa fa-refresh fa-spin"></i></div>';

utilities.setBoxLoading = function ($element, show) {

    if (show) {
        $element.append(utilities.loadingStateHtml);
    } else {

        $element.find('.loading-overlay').remove();
    }

};
