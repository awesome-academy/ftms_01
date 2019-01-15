/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 44);
/******/ })
/************************************************************************/
/******/ ({

/***/ 44:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(45);


/***/ }),

/***/ 45:
/***/ (function(module, exports) {

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#logout').click(function (e) {
        e.preventDefault();
        $.ajax({
            method: 'post',
            url: '/logout',
            data: { form: $('#logout-form').serialize() },
            success: function success() {
                location.reload();
            }
        });
    });
    var counter = 2;
    $('#add-text-subject').click(function (e) {
        e.preventDefault();
        var textNew = $(document.createElement('div')).attr({ "id": "box_group" + counter });
        textNew.after().html('<div class="form-group">\n                <label>T\xEAn ch\u1EE7 \u0111\u1EC1</label>\n                <input required type="text" class="form-control" name="name' + counter + '" placeholder ="T\xEAn ch\u1EE7 \u0111\u1EC1">\n                <label>N\u1ED9i dung</label>\n                <textarea rows="5" class="form-control" name="content' + counter + '" required></textarea>\n            </div>');
        counter++;
        textNew.appendTo('#box_group');
        $('#counter').val(counter - 1);
    });
    $('#delete-text-subject').click(function (e) {
        e.preventDefault();
        if (counter == 2) {
            alert("Bạn không thể xóa!");
            return false;
        }
        counter--;
        $("#box_group" + counter).remove();
    });
    $('.delete').click(function () {
        var result = confirm('Bạn có muốn xóa?');
        if (result) {
            return true;
        }
        return false;
    });
    var n = $('#quantityUser').val();
    for (var i = 1; i <= n; i++) {
        $('.progress-bar' + i).css({
            'width': $('#progress_course' + i).val() + '%',
            'background-color': '#66CC00',
            'color': 'balck'
        }).attr('aria-valuenow');
    }
});

/***/ })

/******/ });