<!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <style>
.clockStyle {
	background-color:#fff;
	//border:#999 2px inset;
	padding:6px;
	color:#0FF;
	font-family:"Arial Black", Gadget, sans-serif;
    font-size:16px;
    font-weight:bold;
	letter-spacing: 2px;
	display:inline;
}
</style>

<div id="clockDisplay" class="clockStyle bg-aqua" ></div>
<script>
function renderTime() {
	var currentTime = new Date();
	var diem = "AM";
	var h = currentTime.getHours();
	var m = currentTime.getMinutes();
        var s = currentTime.getSeconds();
	setTimeout('renderTime()',1000);
    if (h == 0) {
		h = 12;
	} else if (h > 12) { 
		h = h - 12;
		diem="PM";
	}
	if (h < 10) {
		h = "0" + h;
	}
	if (m < 10) {
		m = "0" + m;
	}
	if (s < 10) {
		s = "0" + s;
	}
    var myClock = document.getElementById('clockDisplay');
	myClock.textContent = h + ":" + m + ":" + s + " " + diem;
	myClock.innerText = h + ":" + m + ":" + s + " " + diem;
}
renderTime();
</script>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; <?php date('Y') ?> <a href="http://futureonfinger.com" target="_blank">FF Software Technologies</a>.</strong> All rights reserved.
      </footer>