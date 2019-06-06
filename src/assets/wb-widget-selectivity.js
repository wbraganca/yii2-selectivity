var WbWidgetSelectivity = function(target) {
  this.originalInput = document.querySelector('#' + target);
  this.selectivityInput = document.querySelector('.field-' + target +' .selectivity-input');

  this.setObserver = function() {
    var $self = this;
    var mutationObserver = new MutationObserver(function(mutations) {
      var className = mutations[0].target.className;
      $self.selectivityInput.setAttribute("class", className.trim() + " selectivity-input");
    });

    mutationObserver.observe(this.originalInput, {
      attributes: true,
      attributeOldValue: true,
      attributeFilter: ['class'],
      subtree: true
    });
  }
}
