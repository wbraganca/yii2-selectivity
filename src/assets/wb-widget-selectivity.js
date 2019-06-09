var WbWidgetSelectivity = function (target) {
  this.originalInput = document.querySelector('#' + target);
  this.selectivityInput = document.querySelector('.field-' + target + ' .selectivity-input');

  this.setObserver = function () {
    var $self = this;
    var mutationObserver = new MutationObserver(function (mutations) {
      var className = mutations[0].target.className;
      $self.selectivityInput.setAttribute("class", className.trim() + " selectivity-input");

      var originalInput = jQuery('#' + target);
      var data = originalInput.selectivity('data');

      if (Array.isArray(data)) {
        var values = data.map(function (item) { return item.id; });
        originalInput.val(values);
      } else if (data && typeof data === "object") {
        originalInput.val(data['id']);
      }

      $self.originalInput.dispatchEvent(new Event('change'));
    });

    mutationObserver.observe(this.originalInput, {
      attributes: true,
      attributeOldValue: true,
      subtree: true
    });
  }
}
