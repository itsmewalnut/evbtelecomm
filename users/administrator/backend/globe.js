// Initialize Choices for all dropdowns
var choices = {};

function initializeChoices() {
  // Array of dropdown IDs
  var dropdownIds = ["acc_Branch", "accountStatus", "finalStatus", "acc_type"];
  var filter = [
    "filterBRANCH",
    "filterRNAME",
    "filterACCNO",
    "filterDUEDATE",
    "filterACCSTATUS",
    "filterSTATUS",
  ];

  dropdownIds.forEach(function (id) {
    var element = document.getElementById(id);
    if (element) {
      choices[id] = new Choices(element, {
        searchEnabled: false,
      });
    }
  });

  filter.forEach(function (id) {
    var element = document.getElementById(id);
    if (element) {
      choices[id] = new Choices(element, {
        searchEnabled: true,
      });
    }
  });
}

// Call this function on page load
initializeChoices();

$(document).ready(function () {
  loadGlobeTable();

  $("#imageUpload").change(function (data) {
    var imageFile = data.target.files[0];
    var reader = new FileReader();
    reader.readAsDataURL(imageFile);

    reader.onload = function (evt) {
      $("#imagePreview").attr("src", evt.target.result);
      $("#imagePreview").hide();
      $("#imagePreview").fadeIn(650);
    };
  });
});

function loadGlobeTable() {
  $.ajax({
    url: "../../query/administrator/network_fetch.php",
    method: "POST",
    data: { networkType: "globe", fetchType: "notFilter" },
    success: function (data) {
      // Destroy the existing DataTable instance
      var existingTable = $("#globeTable").DataTable();
      existingTable.clear().destroy();

      try {
        data = JSON.parse(data);
        var globeTable = $("#globeTable").DataTable({
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
          ],
          autoWidth: false,
          responsive: true,
          filter: false,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          data: data.data,
          language: {
            paginate: {
              first: '<i class="fa fa-angle-double-left"></i>',
              previous: '<i class="fa fa-angle-left"></i>',
              next: '<i class="fa fa-angle-right"></i>',
              last: '<i class="fa fa-angle-double-right"></i>',
            },
          },
        });

        globeTable
          .buttons()
          .container()
          .appendTo("#globeTable_wrapper .col-md-6:eq(0)");
      } catch (error) {
        console.error("Error parsing JSON data:", error);
      }
    },
  });
}

$("#addGlobe").on("hidden.bs.modal", function () {
  $(':input[type="submit"]').prop("disabled", false);
  $("#addGlobe-title").text("Add New Account");
  $("#fname").text("");
  $(".textive").removeClass("focused is-focused");
  $("#imagePreview").attr("src", "");
  $("#addGlobe_form")[0].reset();
});

// Add Account
$(document).on("click", "#AddNewGlobe", function () {
  $("#action").val("AddGlobe");
  $(".main-content").removeClass("ps ps--scrolling-y");
});

// Add Account query
$("#addGlobe_form").submit(function (e) {
  $(':input[type="submit"]').prop("disabled", true);
  e.preventDefault();

  $.ajax({
    url: "../../query/administrator/network_query.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function (data) {
      if ($("#action").val() == "AddGlobe") {
        Swal.fire({
          icon: "success",
          titleText: "Succesfully Added!",
          text: "New Account has been created!",
          showConfirmButton: false,
          timer: 2500,
        });
      } else {
        console.log(data);
        Swal.fire({
          icon: "success",
          titleText: "Account Updated!",
          text: "Account information has been updated!",
          showConfirmButton: false,
          timer: 2500,
        });
      }
      $("#addGlobe").modal("hide");
      loadGlobeTable();
      $("#addGlobe_form")[0].reset();
    },
  });
});

// Update Account
$(document).on("click", "#getGlobeUpdate", function () {
  $("#action").val("updateGlobe");
  $(".textive").addClass("focused is-focused");
  $(".main-content").removeClass("ps ps--scrolling-y");

  var mydata = {
    slip_id: $(this).data("id"),
    slip_type: "globe",
  };

  $.ajax({
    url: "../../query/administrator/network_data.php",
    method: "POST",
    dataType: "json",
    data: JSON.stringify(mydata),
    success: function (result) {
      $("#addGlobe-title").text(
        "Update " + result.register_name + " of " + result.branch
      );
      $("#networkID").val(result.globe_id);
      $("#accountNO").val(result.account_no);
      $("#registerNO").val(result.register_no);
      $("#registerName").val(result.register_name);
      $("#dueDate").val(result.duedate);
      $("#acqui_date").val(result.acquisition_date);
      $("#register_add").val(result.register_address);
      $("#globe_username").val(result.username);
      $("#globe_password").val(result.password);
      $("#accMonthly").val(result.monthly);
      $("#accEmail").val(result.email);
      $("#accPhone").val(result.phone);
      $("#acc_serialno").val(result.serial_no);
      $("#accImei1").val(result.imei1);
      $("#accImei2").val(result.imei2);

      // Update Choices values
      if (choices["acc_Branch"]) {
        choices["acc_Branch"].setChoiceByValue(result.branch);
      }
      if (choices["accountStatus"]) {
        choices["accountStatus"].setChoiceByValue(result.account_status);
      }
      if (choices["finalStatus"]) {
        choices["finalStatus"].setChoiceByValue(result.final_status);
      }
      if (choices["acc_type"]) {
        choices["acc_type"].setChoiceByValue(result.account_type);
      }

      $("#username").val(result.username);
    },
  });
});

// Fetching Account info in modal
$(document).on("click", "#getGlobeView", function () {
  $(".main-content").removeClass("ps ps--scrolling-y");
  mydata = {
    slip_id: $(this).data("id"),
    slip_type: "globe",
  };

  $.ajax({
    url: "../../query/administrator/network_data.php",
    method: "POST",
    dataType: "json",
    data: JSON.stringify(mydata),
    success: function (result) {
      $("#viewGlobe_title").text(result.register_name + " Information");
      $("#acc_name").text(result.register_name);
      $("#acc_branch").text(result.branch);
      $("#acc_billing").text(result.account_type);
      $("#acc_datepaid").text(result.date_paid);
      $("#acc_no").text(result.account_no);
      $("#acc_email").text(result.email);
      $("#acc_rno").text(result.register_no);
      $("#acc_address").text(result.register_address);
      $("#acc_username").text(result.username);
      $("#acc_password").text(result.password);
      $("#acc_phone").text(result.phone);
      $("#acc_sno").text(result.serial_no);
      $("#acc_imei1").text(result.imei1);
      $("#acc_imei2").text(result.imei2);

      if (result.paid_amount) {
        $("#acc_amount").text(result.paid_amount);
      } else {
        $("#acc_amount").text("-");
      }

      if (result.final_status == "TRANSMITTED") {
        $("#acc_finalstatus").text("TRANSMITTED");
      } else if (result.final_status == "PAID") {
        $("#acc_finalstatus").text("PAID");
      } else {
        $("#acc_finalstatus").text("UNPAID");
      }

      if (result.remarks) {
        $("#acc_remarks").text(result.remarks);
      } else {
        $("#acc_remarks").text("Encoder has no remarks!");
      }

      // Format the due date
      var dueDate = new Date(result.duedate);
      var options = { year: "numeric", month: "long", day: "numeric" };
      var formattedDueDate = dueDate.toLocaleDateString("en-US", options);
      $("#acc_duedate").text(formattedDueDate);

      // Format the acquisition date
      var acquisitionDate = new Date(result.acquisition_date);
      var formattedAcquisitionDate = acquisitionDate.toLocaleDateString(
        "en-US",
        options
      );
      $("#acc_acqdate").text(formattedAcquisitionDate);

      var $accStatus = $("#acc_status");
      $accStatus.removeClass("bg-gradient-success bg-gradient-secondary");
      if (result.account_status === "ACTIVE") {
        $accStatus.text(result.account_status).addClass("bg-gradient-success");
      } else {
        $accStatus
          .text(result.account_status)
          .addClass("bg-gradient-secondary");
      }
    },
  });
});

// Delete Account query
$("#deleteGlobeForm").submit(function (e) {
  e.preventDefault();
  $.ajax({
    url: "../../query/administrator/delete_query.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function (data) {
      Swal.fire({
        icon: "success",
        titleText: "Account Deleted!",
        text: "Account has been deleted!",
        showConfirmButton: false,
        timer: 2500,
      });
      $("#deleteGlobe").modal("hide");
      loadGlobeTable();
      $("#deleteGlobeForm")[0].reset();
    },
  });
});

// Delete Account
$(document).on("click", "#getGlobeDelete", function () {
  $("#deleteAction").val("Delete");
  $("#deleteGlobeID").val($(this).data("id"));
  $("#deleteMessage").text(
    "Are you sure to delete the account with name of " +
      $(this).data("name") +
      "?"
  );
});

// Search Account
$("#accountSearchForm").submit(function (a) {
  a.preventDefault();
  $.ajax({
    url: "../../query/administrator/filter_fetch.php",
    method: "POST",
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function (data) {
      data = JSON.parse(data);
      var newTable = $("#globeTable").DataTable();
      newTable.clear().destroy();
      var newTable = $("#globeTable")
        .DataTable({
          lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
          ],
          autoWidth: false,
          responsive: true,
          searching: false,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          language: {
            paginate: {
              first: '<i class="fa fa-angle-double-left"></i>',
              previous: '<i class="fa fa-angle-left"></i>',
              next: '<i class="fa fa-angle-right"></i>',
              last: '<i class="fa fa-angle-double-right"></i>',
            },
          },
          data: data.data,
        })
        .buttons()
        .container()
        .appendTo("#globeTable_wrapper .col-md-6:eq(0)");
    },
  });
});

// Reset Table
$("#resetTable").click(function (x) {
  $("#accountSearchForm")[0].reset();
  var newTable = $("#globeTable").DataTable();
  newTable.clear().destroy();
  loadGlobeTable();
});

if (document.querySelector(".datetimepicker")) {
  flatpickr(".datetimepicker", {
    allowInput: true,
    // altInput: true,
    // altFormat: "F j, Y",
    dateFormat: "Y-m-d",
  }); // flatpickr
}

Dropzone.autoDiscover = false;
var drop = document.getElementById("dropzone");
var myDropzone = new Dropzone(drop, {
  url: "../../image/user_avatar",
  addRemoveLinks: true,
  acceptedFiles: ".jpg, .png, .jpeg",
});

if (document.getElementById("choices-quantity")) {
  var element = document.getElementById("choices-quantity");
  const example = new Choices(element, {
    searchEnabled: false,
    itemSelectText: "",
  });
}

if (document.getElementById("choices-material")) {
  var element = document.getElementById("choices-material");
  const example = new Choices(element, {
    searchEnabled: false,
    itemSelectText: "",
  });
}

if (document.getElementById("choices-colors")) {
  var element = document.getElementById("choices-colors");
  const example = new Choices(element, {
    searchEnabled: false,
    itemSelectText: "",
  });
}

// Gallery Carousel
if (document.getElementById("products-carousel")) {
  var myCarousel = document.querySelector("#products-carousel");
  var carousel = new bootstrap.Carousel(myCarousel);
}

// Products gallery

var initPhotoSwipeFromDOM = function (gallerySelector) {
  // parse slide data (url, title, size ...) from DOM elements
  // (children of gallerySelector)
  var parseThumbnailElements = function (el) {
    var thumbElements = el.childNodes,
      numNodes = thumbElements.length,
      items = [],
      figureEl,
      linkEl,
      size,
      item;

    for (var i = 0; i < numNodes; i++) {
      figureEl = thumbElements[i]; // <figure> element
      // include only element nodes
      if (figureEl.nodeType !== 1) {
        continue;
      }

      linkEl = figureEl.children[0]; // <a> element

      size = linkEl.getAttribute("data-size").split("x");

      // create slide object
      item = {
        src: linkEl.getAttribute("href"),
        w: parseInt(size[0], 10),
        h: parseInt(size[1], 10),
      };

      if (figureEl.children.length > 1) {
        // <figcaption> content
        item.title = figureEl.children[1].innerHTML;
      }

      if (linkEl.children.length > 0) {
        // <img> thumbnail element, retrieving thumbnail url
        item.msrc = linkEl.children[0].getAttribute("src");
      }

      item.el = figureEl; // save link to element for getThumbBoundsFn
      items.push(item);
    }

    return items;
  };

  // find nearest parent element
  var closest = function closest(el, fn) {
    return el && (fn(el) ? el : closest(el.parentNode, fn));
  };

  // triggers when user clicks on thumbnail
  var onThumbnailsClick = function (e) {
    e = e || window.event;
    e.preventDefault ? e.preventDefault() : (e.returnValue = false);

    var eTarget = e.target || e.srcElement;

    // find root element of slide
    var clickedListItem = closest(eTarget, function (el) {
      return el.tagName && el.tagName.toUpperCase() === "FIGURE";
    });

    if (!clickedListItem) {
      return;
    }

    // find index of clicked item by looping through all child nodes
    // alternatively, you may define index via data- attribute
    var clickedGallery = clickedListItem.parentNode,
      childNodes = clickedListItem.parentNode.childNodes,
      numChildNodes = childNodes.length,
      nodeIndex = 0,
      index;

    for (var i = 0; i < numChildNodes; i++) {
      if (childNodes[i].nodeType !== 1) {
        continue;
      }

      if (childNodes[i] === clickedListItem) {
        index = nodeIndex;
        break;
      }
      nodeIndex++;
    }

    if (index >= 0) {
      // open PhotoSwipe if valid index found
      openPhotoSwipe(index, clickedGallery);
    }
    return false;
  };

  // parse picture index and gallery index from URL (#&pid=1&gid=2)
  var photoswipeParseHash = function () {
    var hash = window.location.hash.substring(1),
      params = {};

    if (hash.length < 5) {
      return params;
    }

    var vars = hash.split("&");
    for (var i = 0; i < vars.length; i++) {
      if (!vars[i]) {
        continue;
      }
      var pair = vars[i].split("=");
      if (pair.length < 2) {
        continue;
      }
      params[pair[0]] = pair[1];
    }

    if (params.gid) {
      params.gid = parseInt(params.gid, 10);
    }

    return params;
  };

  var openPhotoSwipe = function (
    index,
    galleryElement,
    disableAnimation,
    fromURL
  ) {
    var pswpElement = document.querySelectorAll(".pswp")[0],
      gallery,
      options,
      items;

    items = parseThumbnailElements(galleryElement);

    // define options (if needed)
    options = {
      // define gallery index (for URL)
      galleryUID: galleryElement.getAttribute("data-pswp-uid"),

      getThumbBoundsFn: function (index) {
        // See Options -> getThumbBoundsFn section of documentation for more info
        var thumbnail = items[index].el.getElementsByTagName("img")[0], // find thumbnail
          pageYScroll = window.scrollY || document.documentElement.scrollTop,
          rect = thumbnail.getBoundingClientRect();

        return {
          x: rect.left,
          y: rect.top + pageYScroll,
          w: rect.width,
        };
      },
    };

    // PhotoSwipe opened from URL
    if (fromURL) {
      if (options.galleryPIDs) {
        // parse real index when custom PIDs are used
        // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
        for (var j = 0; j < items.length; j++) {
          if (items[j].pid == index) {
            options.index = j;
            break;
          }
        }
      } else {
        // in URL indexes start from 1
        options.index = parseInt(index, 10) - 1;
      }
    } else {
      options.index = parseInt(index, 10);
    }

    // exit if index not found
    if (isNaN(options.index)) {
      return;
    }

    if (disableAnimation) {
      options.showAnimationDuration = 0;
    }

    // Pass data to PhotoSwipe and initialize it
    gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
    gallery.init();
  };

  // loop through all gallery elements and bind events
  var galleryElements = document.querySelectorAll(gallerySelector);

  for (var i = 0, l = galleryElements.length; i < l; i++) {
    galleryElements[i].setAttribute("data-pswp-uid", i + 1);
    galleryElements[i].onclick = onThumbnailsClick;
  }

  // Parse URL and open gallery if it contains #&pid=3&gid=1
  var hashData = photoswipeParseHash();
  if (hashData.pid && hashData.gid) {
    openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
  }
};

// execute above function
initPhotoSwipeFromDOM(".my-gallery");

(function (a, s, y, n, c, h, i, d, e) {
  s.className += " " + y;
  h.start = 1 * new Date();
  h.end = i = function () {
    s.className = s.className.replace(RegExp(" ?" + y), "");
  };
  (a[n] = a[n] || []).hide = h;
  setTimeout(function () {
    i();
    h.end = null;
  }, c);
  h.timeout = c;
})(window, document.documentElement, "async-hide", "dataLayer", 4000, {
  "GTM-K9BGS8K": true,
});

(function (i, s, o, g, r, a, m) {
  i["GoogleAnalyticsObject"] = r;
  (i[r] =
    i[r] ||
    function () {
      (i[r].q = i[r].q || []).push(arguments);
    }),
    (i[r].l = 1 * new Date());
  (a = s.createElement(o)), (m = s.getElementsByTagName(o)[0]);
  a.async = 1;
  a.src = g;
  m.parentNode.insertBefore(a, m);
})(
  window,
  document,
  "script",
  "https://www.google-analytics.com/analytics.js",
  "ga"
);
ga("create", "UA-46172202-22", "auto", {
  allowLinker: true,
});
ga("set", "anonymizeIp", true);
ga("require", "GTM-K9BGS8K");
ga("require", "displayfeatures");
ga("require", "linker");
ga("linker:autoLink", ["2checkout.com", "avangate.com"]);

(function (w, d, s, l, i) {
  w[l] = w[l] || [];
  w[l].push({
    "gtm.start": new Date().getTime(),
    event: "gtm.js",
  });
  var f = d.getElementsByTagName(s)[0],
    j = d.createElement(s),
    dl = l != "dataLayer" ? "&l=" + l : "";
  j.async = true;
  j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
  f.parentNode.insertBefore(j, f);
})(window, document, "script", "dataLayer", "GTM-NKDMSK6");
