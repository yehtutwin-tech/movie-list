<?php
  function dt_format($dt) {
    return date('M d, Y h:i A', strtotime($dt));
  }