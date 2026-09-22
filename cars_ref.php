<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Choose Your Cab | Book Outstation Taxi – Haier Drop Taxi Chennai</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Select your preferred cab type for your outstation trip. Choose from Hatchback, Sedan, SUV, Innova, and Innova Crysta. Transparent per-km fares. Book with Haier Drop Taxi.">
<meta name="keywords" content="select cab Chennai, choose outstation taxi, Hatchback cab, Sedan taxi, SUV cab, Innova taxi, book cab online Chennai">
<meta name="robots" content="index, follow">
<link rel="canonical" href="https://haierdroptaxi.com/cars.php">
<meta property="og:type" content="website">
<meta property="og:url" content="https://haierdroptaxi.com/cars.php">
<meta property="og:title" content="Choose Your Cab – Haier Drop Taxi Chennai">
<meta property="og:description" content="Pick from Hatchback, Sedan, SUV, Innova or Innova Crysta for your outstation journey. Fair per-km pricing.">
<meta property="og:image" content="https://haierdroptaxi.com/assets/logo.png">
<link rel="icon" type="image/x-icon" href="/favicon.png">
<script src="https://cdn.tailwindcss.com"></script>
<style>
  /* ===== HAIER BRAND BLUE OVERRIDE (#0066cc) ===== */
  .text-sky-400,.text-sky-500,.text-sky-600 { color:#0066cc !important; }
  .bg-sky-50  { background-color:#e6f0ff !important; }
  .bg-sky-500 { background-color:#0066cc !important; }
  .bg-sky-600 { background-color:#004fa3 !important; }
  .border-sky-200 { border-color:#b3d0f5 !important; }
  .border-sky-300 { border-color:#80b3ee !important; }
  .border-sky-400,.border-sky-500 { border-color:#0066cc !important; }
  .hover\:bg-sky-600:hover { background-color:#004fa3 !important; }
  .focus-within\:border-sky-400:focus-within { border-color:#0066cc !important; }
  .vehicle-tab.active { border:2px solid #0066cc; }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<!-- Google tag (gtag.js) --><script async src="https://www.googletagmanager.com/gtag/js?id=AW-18379336958"></script><script>  window.dataLayer = window.dataLayer || [];  function gtag(){dataLayer.push(arguments);}  gtag('js', new Date());  gtag('config', 'AW-18379336958');</script>
</head>

<body class="bg-gray-100">

<?php include('header.php'); ?>

<div class="max-w-md mx-auto p-3">

<!-- STEP INDICATOR -->
<div class="flex items-center justify-center mb-4 text-xs font-semibold gap-1">
  <span class="flex items-center gap-1 text-sky-500"><i class="fa-solid fa-circle-check"></i> Route</span>
  <div class="h-px w-7 bg-sky-300 mx-1"></div>
  <span class="bg-sky-500 text-white px-3 py-1 rounded-full">&#9313; Select Cab</span>
  <div class="h-px w-7 bg-gray-200 mx-1"></div>
  <span class="text-gray-400">&#9314; Your Details</span>
</div>

<!-- ROUTE BAR -->
<div class="bg-gray-900 text-white rounded-xl p-3 mb-3 flex items-center gap-3">
  <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(0,102,204,0.2)">
    <i class="fa-solid fa-taxi text-sky-400"></i>
  </div>
  <div class="flex-1 min-w-0">
    <div class="font-bold text-sm truncate" id="routeText"></div>
    <div class="text-xs text-gray-400 mt-0.5">Route loaded — choose trip type and date below</div>
  </div>
  <a href="/" class="flex-shrink-0 text-xs bg-sky-500 text-white px-3 py-1.5 rounded-full flex items-center gap-1">
    <i class="fa-solid fa-pen text-xs"></i> Edit
  </a>
</div>

<!-- TRIP DETAILS -->
<div class="bg-white rounded-xl shadow p-4 mb-3">
  <div class="text-xs font-bold text-gray-500 tracking-widest mb-3 flex items-center gap-1.5" style="font-size:10px">
    <i class="fa-solid fa-list-ul text-sky-500"></i> TRIP DETAILS
  </div>

  <!-- One Way / Round Trip Toggle -->
  <div class="flex rounded-xl border border-gray-200 overflow-hidden mb-4 text-sm font-bold">
    <button id="btn-oneway" onclick="setTripType('oneWay')"
      class="flex-1 py-2.5 flex items-center justify-center gap-1.5 bg-gray-900 text-white transition-colors">
      &#8658; One Way
    </button>
    <button id="btn-roundtrip" onclick="setTripType('roundTrip')"
      class="flex-1 py-2.5 flex items-center justify-center gap-1.5 text-gray-500 transition-colors">
      &#8652; Round Trip
    </button>
  </div>

  <!-- Date & Time -->
  <div class="grid grid-cols-2 gap-3 mb-3">
    <div>
      <label class="block mb-1.5 font-bold text-gray-500 uppercase" style="font-size:10px;letter-spacing:0.08em">DATE <span class="text-red-400">*</span></label>
      <div class="flex items-center gap-2 border border-gray-200 rounded-lg px-3 py-2.5">
        <i class="fa-regular fa-calendar text-sky-500 text-sm flex-shrink-0"></i>
        <input type="date" id="trip-date" class="text-sm font-medium outline-none w-full bg-transparent">
      </div>
    </div>
    <div>
      <label class="block mb-1.5 font-bold text-gray-500 uppercase" style="font-size:10px;letter-spacing:0.08em">TIME <span class="text-red-400">*</span></label>
      <div class="flex items-center gap-2 border border-gray-200 rounded-lg px-3 py-2.5">
        <i class="fa-regular fa-clock text-sky-500 text-sm flex-shrink-0"></i>
        <select id="trip-time" class="text-sm font-medium outline-none w-full bg-transparent cursor-pointer">
          <option value="ASAP">ASAP</option>
          <option>12:00 AM</option><option>12:30 AM</option><option>01:00 AM</option><option>01:30 AM</option>
          <option>02:00 AM</option><option>02:30 AM</option><option>03:00 AM</option><option>03:30 AM</option>
          <option>04:00 AM</option><option>04:30 AM</option><option>05:00 AM</option><option>05:30 AM</option>
          <option>06:00 AM</option><option>06:30 AM</option><option>07:00 AM</option><option>07:30 AM</option>
          <option>08:00 AM</option><option>08:30 AM</option><option>09:00 AM</option><option>09:30 AM</option>
          <option>10:00 AM</option><option>10:30 AM</option><option>11:00 AM</option><option>11:30 AM</option>
          <option>12:00 PM</option><option>12:30 PM</option><option>01:00 PM</option><option>01:30 PM</option>
          <option>02:00 PM</option><option>02:30 PM</option><option>03:00 PM</option><option>03:30 PM</option>
          <option>04:00 PM</option><option>04:30 PM</option><option>05:00 PM</option><option>05:30 PM</option>
          <option>06:00 PM</option><option>06:30 PM</option><option>07:00 PM</option><option>07:30 PM</option>
          <option>08:00 PM</option><option>08:30 PM</option><option>09:00 PM</option><option>09:30 PM</option>
          <option>10:00 PM</option><option>10:30 PM</option><option>11:00 PM</option><option>11:30 PM</option>
        </select>
      </div>
    </div>
  </div>

  <!-- Return Date (Round Trip only) -->
  <div id="return-date-row" class="mb-3 hidden">
    <label class="block mb-1.5 font-bold text-gray-500 uppercase" style="font-size:10px;letter-spacing:0.08em">RETURN DATE</label>
    <div class="flex items-center gap-2 border border-gray-200 rounded-lg px-3 py-2.5">
      <i class="fa-regular fa-calendar-check text-sky-500 text-sm flex-shrink-0"></i>
      <input type="date" id="return-date" class="text-sm font-medium outline-none w-full bg-transparent">
    </div>
  </div>

  <!-- Distance display -->
  <div class="text-xs font-semibold text-green-600 flex items-center gap-1.5" style="min-height:18px">
    <i class="fa-solid fa-circle-check"></i>
    <span id="dist-text">Calculating distance&hellip;</span>
  </div>

  <!-- Fare note -->
  <div class="mt-2 rounded-lg p-2 text-xs" style="background:#fffbeb;border:1px solid #fde68a;color:#92400e">
    &#128161; Fares update automatically based on your route distance. Toll, parking &amp; state permits are extra.
  </div>
</div>

<!-- H1 SEO -->
<h1 class="sr-only">Book Outstation Cab from Chennai &#8211; Select Your Vehicle Type</h1>

<!-- SELECT CABS label -->
<div class="flex items-center gap-2 mb-2">
  <span class="font-bold text-gray-800">Select Cabs</span>
  <span class="bg-gray-200 text-gray-700 text-xs font-bold px-2 py-0.5 rounded-full">4 Options</span>
</div>

<!-- VEHICLE SELECT -->
<div class="flex gap-3 overflow-x-auto pb-2 mb-3">

  <div onclick="selectType('hatchback',this)" class="vehicle-tab active bg-white rounded-lg p-2 shadow cursor-pointer">
    <img src="https://media.mahindrafirstchoice.com/live_web_images/usedcarsimg/mfc/4351/577927/cover_image-20230718161449.jpeg" class="h-12 mx-auto" alt="Hatchback cab for outstation booking" loading="lazy">
    <p class="text-xs mt-1">Hatchback</p>
  </div>

  <div onclick="selectType('sedan',this)" class="vehicle-tab bg-white rounded-lg p-2 shadow cursor-pointer">
    <img src="https://s3.ap-south-1.amazonaws.com/cb360static/uploads/333742ef-2f6c-4f06-9664-faede6dcc1d8--New%20Project%20-%202025-01-16T161103.598.webp" class="h-12 mx-auto" alt="Sedan taxi for one way and round trip" loading="lazy">
    <p class="text-xs mt-1">Sedan</p>
  </div>

  <div onclick="selectType('suv',this)" class="vehicle-tab bg-white rounded-lg p-2 shadow cursor-pointer">
    <img src="https://i.pinimg.com/564x/ae/ac/cb/aeaccb280abfd5f4029fc2b48dc9dc73.jpg" class="h-12 mx-auto" alt="SUV cab for outstation travel" loading="lazy">
    <p class="text-xs mt-1">SUV</p>
  </div>

  <div onclick="selectType('crysta',this)" class="vehicle-tab bg-white rounded-lg p-2 shadow cursor-pointer">
    <img src="https://images.ctfassets.net/5iu1oya45cp3/tJyQQpUfF0XuYTl6soPvz/c42def0a66d1aa5e33e82ab25385c0d8/New_Project__13_.png" class="h-12 mx-auto" alt="Innova Crysta cab for premium outstation trips" loading="lazy">
    <p class="text-xs mt-1">Innova Crysta</p>
  </div>

</div>

<!-- CAR CARD -->
<div id="carCard"></div>

</div>
<!-- TRUST / BENEFITS SECTION (COMPACT HEIGHT) -->
<div class="max-w-md mx-auto px-3 mt-3">
  <div class="bg-sky-50 border border-sky-200 rounded-full shadow
              flex items-center justify-between px-3 py-2">

    <div class="flex-1 flex flex-col items-center text-center gap-0.5">
      <i class="fa-solid fa-indian-rupee-sign text-sky-600 text-lg"></i>
      <p class="text-[13px] font-semibold leading-tight">
        Book Now<br>
        <span class="font-normal text-[12px]">Zero Cost</span>
      </p>
    </div>

    <div class="w-px h-8 bg-sky-200"></div>

    <div class="flex-1 flex flex-col items-center text-center gap-0.5">
      <i class="fa-solid fa-ban text-sky-600 text-lg"></i>
      <p class="text-[13px] font-semibold leading-tight">
        Free Cancel<br>
        <span class="font-normal text-[12px]">Till 1 Hour</span>
      </p>
    </div>

    <div class="w-px h-8 bg-sky-200"></div>

    <div class="flex-1 flex flex-col items-center text-center gap-0.5">
      <i class="fa-solid fa-headset text-sky-600 text-lg"></i>
      <p class="text-[13px] font-semibold leading-tight">
        24 × 7<br>
        <span class="font-normal text-[12px]">Support</span>
      </p>
    </div>

  </div>
</div>



<?php include('footer.php'); ?>

<script>
function generateBookingId(){
  const d = new Date();
  return "MDT" +
    d.getDate().toString().padStart(2,"0") +
    (d.getMonth()+1).toString().padStart(2,"0") +
    d.getFullYear().toString().slice(-2) +
    Math.floor(100 + Math.random()*900);
}

/* LOAD BOOKING DATA */
const bookingData = JSON.parse(localStorage.getItem("bookingData"));
if(!bookingData){ location.href="index.php"; }

document.getElementById('routeText').textContent = (bookingData.from || '') + ' → ' + (bookingData.to || '');

/* ===== TRIP DETAILS INIT ===== */
(function initTripDetails(){
  var today = new Date().toISOString().split('T')[0];
  var dateEl = document.getElementById('trip-date');
  var timeEl = document.getElementById('trip-time');
  var returnEl = document.getElementById('return-date');

  dateEl.min = today;
  dateEl.value = bookingData.date || today;
  returnEl.min = dateEl.value;
  if(bookingData.returnDate) returnEl.value = bookingData.returnDate;

  // Restore time selection
  if(bookingData.time){
    for(var i=0;i<timeEl.options.length;i++){
      if(timeEl.options[i].value === bookingData.time || timeEl.options[i].text === bookingData.time){
        timeEl.selectedIndex = i; break;
      }
    }
  }

  setTripTypeUI(bookingData.tripType || 'oneWay');

  dateEl.addEventListener('change', function(){
    bookingData.date = this.value;
    returnEl.min = this.value;
  });
  timeEl.addEventListener('change', function(){ bookingData.time = this.value; });
  returnEl.addEventListener('change', function(){ bookingData.returnDate = this.value; });
})();

function setTripType(type){
  bookingData.tripType = type;
  setTripTypeUI(type);
  renderCard();
}

function setTripTypeUI(type){
  var ow = document.getElementById('btn-oneway');
  var rt = document.getElementById('btn-roundtrip');
  var rr = document.getElementById('return-date-row');
  if(type === 'roundTrip'){
    rt.style.background = '#111827'; rt.style.color = '#fff';
    ow.style.background = ''; ow.style.color = '#6b7280';
    rr.classList.remove('hidden');
  } else {
    ow.style.background = '#111827'; ow.style.color = '#fff';
    rt.style.background = ''; rt.style.color = '#6b7280';
    rr.classList.add('hidden');
  }
}

/* ===== GOOGLE MAPS DISTANCE ===== */
var mapsReady = false;
(function loadMaps(){
  var s = document.createElement('script');
  s.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCH5nO7MHp_16hu6xl3BITgFy43xF1GLt0&libraries=places&callback=onMapsReady';
  s.async = true; s.defer = true; document.head.appendChild(s);
})();

function onMapsReady(){
  mapsReady = true;
  if(bookingData.from && bookingData.to) calculateDistance();
}

function calculateDistance(){
  if(!mapsReady) return;
  var distText = document.getElementById('dist-text');
  distText.textContent = 'Calculating distance…';
  var svc = new google.maps.DistanceMatrixService();
  svc.getDistanceMatrix({
    origins:[bookingData.from], destinations:[bookingData.to],
    travelMode:'DRIVING', region:'in'
  }, function(res, status){
    if(status==='OK' && res.rows[0].elements[0].status==='OK'){
      var km = Math.round(res.rows[0].elements[0].distance.value/1000);
      bookingData.distance = km;
      localStorage.setItem('bookingData', JSON.stringify(bookingData));
      distText.textContent = 'Distance: ' + km + ' km · Fares updated';
      renderCard();
    } else {
      distText.textContent = 'Distance unavailable — fares are estimates.';
    }
  });
}

/* TARIFF CONFIG */
<?php
$tariffsFile = __DIR__ . '/admin/tariffs.json';
if (!file_exists($tariffsFile) && isset($_SERVER['DOCUMENT_ROOT'])) {
    $tariffsFile = $_SERVER['DOCUMENT_ROOT'] . '/admin/tariffs.json';
}
$tariffsJson = file_exists($tariffsFile) ? file_get_contents($tariffsFile) : '{}';
?>
const cars = <?php echo $tariffsJson; ?>;

let currentType="hatchback";
const selectedCarData = JSON.parse(localStorage.getItem("selectedCarData") || "{}");
if(selectedCarData && selectedCarData.car){
  const carMap = { "Hatchback": "hatchback", "Sedan": "sedan", "SUV": "suv", "Innova Crysta": "crysta" };
  const mapped = carMap[selectedCarData.car] || selectedCarData.car.toLowerCase();
  if(cars[mapped]) {
    currentType = mapped;
  }
}

// Set active tab on load
document.querySelectorAll('.vehicle-tab').forEach(tab => {
  const onclickAttr = tab.getAttribute('onclick') || '';
  if(onclickAttr.includes(`'${currentType}'`)){
    tab.classList.add('active');
  } else {
    tab.classList.remove('active');
  }
});

let finalTotalKms = 0; // ✅ global km holder

/* TAB SWITCH */
function selectType(type,el){
  // 1️⃣ car type update
  currentType = type;

  // 2️⃣ tab active style
  document.querySelectorAll('.vehicle-tab')
    .forEach(t => t.classList.remove('active'));
  el.classList.add('active');

  // 3️⃣ price card refresh
  renderCard();

}


/* RENDER CARD */
function renderCard(){
  const c=cars[currentType];
  const isRound = bookingData.tripType==="roundTrip";
  // ✅ ALWAYS treat bookingData.distance as ONE-WAY Google distance
const googleDistance = Number(bookingData.distance || 0);

if(isRound){
  // Round Trip = One Way × 2
  finalTotalKms = googleDistance * 2;

  // Minimum 250 km
  if(finalTotalKms < 250){
    finalTotalKms = 250;
  }
}else{
  // One Way
  finalTotalKms = googleDistance;

  // Minimum 130 km
  if(finalTotalKms < 130){
    finalTotalKms = 130;
  }
}




  const rate = isRound ? c.roundtrip : c.oneway;

  const totalFare = Math.round((finalTotalKms * rate) + c.driver);

  carCard.innerHTML = `
  <div class="bg-white rounded-xl shadow p-4">
    <div class="flex gap-3">
      <div class="flex-1">
        <h3 class="font-bold text-lg">${c.name}</h3>

        <div class="flex items-center gap-2 text-xs text-gray-600 mb-2">
          <span>${c.seats} seater AC Cab</span>
          <span class="bg-black text-white px-2 rounded flex items-center gap-1">
            4.5 <i class="fa fa-star text-yellow-400"></i>
          </span>
        </div>

        <div class="text-2xl font-extrabold text-sky-600">₹${totalFare}</div>

        <div class="mt-3 space-y-1 text-sm text-gray-700">
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-route text-blue-600"></i>
            <b>${finalTotalKms}</b> kms included
          </div>
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-user-shield text-green-600"></i>
            Driver allowance included
          </div>
          <div class="flex items-center gap-2">
            <i class="fa-solid fa-road text-blue-600"></i>
            State Tax & Toll Extra
          </div>
        </div>
      </div>

      <img src="${c.img}" class="h-24 object-contain">
    </div>

    <button 
  class="mt-4 w-full bg-sky-500 hover:bg-sky-600 text-white py-3 rounded-lg font-bold book-btn"
  data-type="${currentType}"
  data-fare="${totalFare}"
  data-rate="${rate}"
  data-driver="${c.driver}">
  BOOK CAR
</button>

  </div>`;
  
}


/* WHATSAPP FLAG */
const enableWhatsApp = false;

/* TELEGRAM FUNCTION */
async function sendBookingToTelegram(data){

  const bookingId = generateBookingId();
  data.bookingId = bookingId;

  const message =
`🚕 <b>Haier Drop Taxi - Confirmed Booking</b>

🆔 <b>Booking ID:</b> ${bookingId}
👤 <b>Name:</b> ${data.name}
📞 <b>Phone:</b> ${data.phone}
📍 <b>From:</b> ${data.from}
🏁 <b>To:</b> ${data.to}
📅 <b>Pickup Date:</b> ${data.date}
⏰ <b>Time:</b> ${data.time}
${data.tripType === "roundTrip" ? `🔁 <b>Return Date:</b> ${data.returnDate}\n` : ''}🚗 <b>Trip Type:</b> ${data.tripType === "roundTrip" ? "Round Trip" : "One Way Trip"}
🚖 <b>Car:</b> ${data.carName} (${data.seats}+1 A/C)
📍 <b>Distance:</b> ${data.distance} KM
💰 <b>Rate:</b> ₹${data.rate}/km
🧑🏻‍💼 <b>Driver Bata:</b> ₹${data.driverBata}
💵 <b>Total Fare:</b> ₹${data.fare}

📞 <b>Contact:</b> +91 6380130150
🌐 www.haierdroptaxi.com`;

  const botToken = "8828781120:AAFMbHUpTAdqkqTEVWMxz4JXide1JntC-ik";
  const chatId   = "8047576157";

  try{
    await fetch(`https://api.telegram.org/bot${botToken}/sendMessage`,{
      method:"POST",
      headers:{ "Content-Type":"application/json" },
      body: JSON.stringify({
        chat_id: chatId,
        text: message,
        parse_mode: "HTML"
      })
    });
    return true;
  }catch(e){
    console.error('Telegram error:', e);
    return false;
  }
}

/* EMAIL FUNCTION */
async function sendBookingEmail(data){
  const htmlBody = `
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden;">
      <div style="background-color: #0d6efd; color: #fff; padding: 16px 20px;">
        <h2 style="margin: 0; font-size: 20px;">🚖 Haier Drop Taxi - Confirmed Booking (${data.bookingId})</h2>
      </div>
      <div style="padding: 20px; background-color: #f9f9f9;">
        <table style="width: 100%; border-collapse: collapse; font-size: 15px;">
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold; width: 40%;">Booking ID:</td><td style="padding: 10px 0; color: #0d6efd; font-weight: bold;">${data.bookingId}</td></tr>
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Customer Name:</td><td style="padding: 10px 0;">${data.name}</td></tr>
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Phone Number:</td><td style="padding: 10px 0;"><a href="tel:${data.phone}" style="color: #0d6efd; text-decoration: none; font-weight: bold;">${data.phone}</a></td></tr>
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Pickup Location:</td><td style="padding: 10px 0;">${data.from}</td></tr>
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Drop Location:</td><td style="padding: 10px 0;">${data.to}</td></tr>
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Pickup Date & Time:</td><td style="padding: 10px 0;">${data.date} at ${data.time}</td></tr>
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Trip Type:</td><td style="padding: 10px 0;">${data.tripType === "roundTrip" ? "Round Trip" : "One Way Trip"}</td></tr>
          ${data.tripType === "roundTrip" ? `<tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Return Date:</td><td style="padding: 10px 0;">${data.returnDate}</td></tr>` : ''}
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Car Selected:</td><td style="padding: 10px 0;">${data.carName} (${data.seats}+1 A/C)</td></tr>
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Trip Distance:</td><td style="padding: 10px 0;">${data.distance} KM</td></tr>
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Rate per KM:</td><td style="padding: 10px 0;">₹${data.rate}/km</td></tr>
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold;">Driver Bata:</td><td style="padding: 10px 0;">₹${data.driverBata}</td></tr>
          <tr style="border-bottom: 1px solid #eee;"><td style="padding: 10px 0; font-weight: bold; font-size: 16px;">Total Fare:</td><td style="padding: 10px 0; color: #198754; font-size: 18px; font-weight: bold;">₹${data.fare}</td></tr>
        </table>
      </div>
    </div>
  `;

  try{
    await fetch('/send_mail.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({
        to: ['haierdroptaxi@gmail.com'],
        subject: `✅ Confirmed Booking [${data.bookingId}]: ${data.name} (${data.from} → ${data.to})`,
        message: htmlBody
      })
    });
  }catch(e){
    console.error('Email error:', e);
  }
}

/* BOOK CAR → goes to Step 3 */
function bookCar(type, totalFare, rate, driverBata){
  var dateVal = document.getElementById('trip-date').value;
  var timeVal = document.getElementById('trip-time').value;
  var returnVal = document.getElementById('return-date').value;

  if(!dateVal){
    alert('Please select a pickup date before proceeding.');
    return;
  }
  if((bookingData.tripType === 'roundTrip') && !returnVal){
    alert('Please select a return date for Round Trip.');
    return;
  }

  var c = cars[type];
  bookingData.date = dateVal;
  bookingData.time = timeVal || 'ASAP';
  if(bookingData.tripType === 'roundTrip') bookingData.returnDate = returnVal;

  bookingData.carName = c.name;
  bookingData.model = c.name + ' or Similar';
  bookingData.seats = c.seats;
  bookingData.fare = totalFare;
  bookingData.rate = rate;
  bookingData.driverBata = driverBata;
  bookingData.distance = finalTotalKms;

  localStorage.setItem('bookingData', JSON.stringify(bookingData));
  window.location.href = 'customer-details.php';
}




/* INIT */
renderCard();



document.addEventListener("click", function(e){
  if(!e.target.classList.contains("book-btn")) return;

  const btn = e.target;

  const type   = btn.dataset.type;
  const fare   = Number(btn.dataset.fare);
  const rate   = Number(btn.dataset.rate);
  const driver = Number(btn.dataset.driver);

  bookCar(type, fare, rate, driver);
});

</script>

</body>
</html>
