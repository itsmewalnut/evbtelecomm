// Count To
function startCountUp(id) {
  const element = document.getElementById(id);
  if (element) {
    const countUp = new CountUp(id, element.getAttribute("countTo"));
    if (!countUp.error) {
      countUp.start();
    } else {
      console.error(countUp.error);
    }
  }
}

[
  "globe_count",
  "smart_count",
  "pldt_count",
  "overall_count",
  "globe_stats",
  "smart_stats",
  "pldt_stats",
].forEach(startCountUp);
