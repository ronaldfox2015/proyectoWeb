var _createClass = (function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; })();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var PositEPass = (function () {
	function PositEPass() {
		_classCallCheck(this, PositEPass);

		$(".posit-Epass-Footer").on("click", this.ocultarPositEpass);
		$(".posit-Epass-Consulta-Oculta-background").on("click", this.mostrarPositEpass);
	}

	_createClass(PositEPass, [{
		key: "ocultarPositEpass",
		value: function ocultarPositEpass() {
			$(".posit-Epass-Consulta-Oculta").css("display", "block");
			$(".posit-Epass-Container").css("bottom", "20px");
			$(".posit-Epass-Consulta").css("display", "none");
		}
	}, {
		key: "mostrarPositEpass",
		value: function mostrarPositEpass() {
			$(".posit-Epass-Consulta-Oculta").css("display", "none");
			$(".posit-Epass-Container").css("bottom", "0");
			$(".posit-Epass-Consulta").css("display", "block");
		}
	}]);

	return PositEPass;
})();