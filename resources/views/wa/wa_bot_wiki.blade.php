<x-app-layout :assets="$assets ?? []">
<div class="row">
<div class="bd-example">
    <div class="alert alert-success mb-2 mt-0" role="alert">
        <h4 class="alert-heading">Well done! WhatsApp blasting ready to his job.</h4>
    </div>
</div>
</div>
<div class="row">
   <div class="col-sm-12 col-lg-4" id="log">
      <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                     <h4 class="card-title">Wa Log</h4>
               </div>
            </div>
            <div class="card-body">
            <img id="qr" class="center" alt="qr code" style="display: none ;" src="http://127.0.0.1:5100/default.gif"></img>
            <div id="logs"></div>
            </div>
      </div>
   </div>
   <div class="col-sm-12 col-lg-8" id="rules">
      <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                     <h4 class="card-title">Blasting Rules</h4>
               </div>
            </div>
            <div class="card-body">
            <div class="bd-example">
               <div class="accordion" id="accordionExample">
                  <div class="accordion-item">
                        <h4 class="accordion-header" id="headingOne">
                           <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Accordion Item #1
                           </button>
                        </h4>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                           </div>
                        </div>
                  </div>
                  <div class="accordion-item">
                        <h4 class="accordion-header" id="headingTwo">
                           <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Accordion Item #2
                           </button>
                        </h4>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                           </div>
                        </div>
                  </div>
                  <div class="accordion-item">
                        <h4 class="accordion-header" id="headingThree">
                           <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Accordion Item #3
                           </button>
                        </h4>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                           </div>
                        </div>
                  </div>
               </div>
            </div>
            </div>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.0.1/socket.io.min.js" integrity="sha512-gVG6WRMUYFaIdoocaxbqd02p3DUbhReTBWc7NTGB96i7vONrr7GuCZJHFFmkXEhpwilIWUnfRIMSlKaApwd/jg==" crossorigin="anonymous"></script>
    <script>
      $.ajax('http://127.0.0.1:5100/bot2/connection', {
         type: 'POST',  // http method
         contentType: 'application/json',
         crossDomain: true,
         success: function (data, status, xhr) {
            // $('p').append('status: ' + status + ', data: ' + data);
            console.log(data['connection']);
            if (data['connection'] == "CONNECTED") {
               $('#log').css("display", "none");
            }
         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log(errorMessage);

         }
      });

      const socket = io('127.0.0.1:5100');
      console.log(socket);
      socket.on("wa_bot2_qr", (data) => {
        console.log(data);
        document.getElementById("qr").src = data;
      });
      var logsEl = $("#logs");
      socket.on("wa_bot2_log", (data) => {
        if (data.includes("QR")) {
          $('#qr').removeAttr("style")
        }
        if (data.includes("WhatsApp is ready!")) {
          $('#qr').css("display", "none");
        }
        console.log(data);
        logsEl.prepend($('<p>').text(data));
      });
    </script>
</x-app-layout>
