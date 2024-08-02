
(function ($) {
  "use strict";
  $.fn.exists = function () {
    return this.length > 0;
  };


  function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }


  var baseUrl = window.location.origin;
  var url = baseUrl + '/Incident/get/data';
  var Counts = [];
  var labels = [];
  var colors = [];
  $.ajax({
    url: url,
    type: 'GET',
    success: function (data) {
      // تعبئة قيم البيانات والتصنيفات من البيانات المسترجعة
      $.each(data.data, function (key, value) {
        Counts.push(value.Counts);
        labels.push(value.incident_status);
        colors.push(getRandomColor());
      });
    }
  });
  console.log(labels)
  var config6 = {
    type: 'pie',
    data: {
      datasets: [{
        data: Counts,
        backgroundColor: colors,
        label: 'نسبة احصائيات البلاغات'
      }],
      labels: labels
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        position: 'top',
      },
      title: {
        display: false,
        text: 'نسبة احصائيات البلاغات'
      },
      animation: {
        animateScale: true,
        animateRotate: true
      }
    }
  };
  var config7 = {
    type: 'bar',
    data: {
      datasets: [{
        data: Counts,
        backgroundColor: colors,
        label: 'نسبة احصائيات البلاغات'
      }],
      labels: labels
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        position: 'top',
      },
      title: {
        display: false,
        text: 'نسبة احصائيات البلاغات'
      },
      animation: {
        animateScale: true,
        animateRotate: true
      }
    }
  };
  // doughnut

  window.onload = function () {
    if ($('#canvas6').exists()) {
      var ctx6 = document.getElementById("canvas6").getContext("2d");
      window.myLine6 = new Chart(ctx6, config6);
    }
    if ($('#canvas7').exists()) {
      var ctx7 = document.getElementById("canvas7").getContext("2d");
      window.myLine7 = new Chart(ctx7, config7);
    }
  }

})(jQuery);

