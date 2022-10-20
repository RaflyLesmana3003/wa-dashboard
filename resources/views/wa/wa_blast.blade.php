<x-app-layout :assets="$assets ?? []">
<div class="row">
   <div class="bd-example mb-2">
      <div class="btn-group" role="group" aria-label="Basic example">
         <button type="button" class="btn btn-primary">
            <span class="btn-inner">
               <svg width="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                     </path>
               </svg>
            </span>
            Blaster
         </button>
         <button type="button" class="btn btn-light">History</button>
      </div>
   </div>
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
   
   <div class="col-sm-12 col-lg-8">
      <div class="card">
               @if(session('status'))
                  <div class="alert alert-success">
                     {{ session('status') }}
                  </div>   
               @endif
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                        <h4 class="card-title">WhatsApp Blast</h4>
                  </div>
               </div>
               <div class="card-body">
               <form name="submit-form" id="submit-form" method="post" action="{{url('wa/submit')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                        <label class="form-label" for="template">Template Text</label>
                        <textarea class="form-control" name="template" id="template" rows="5" required></textarea>
                  </div>
                  <div class="form-group">
                        <label for="csv" class="form-label custom-file-input">Choose CSV file</label>
                        <input class="form-control" name="csv" type="file" id="csv" required>
                  </div>
                  <hr></hr>
                  <div class="form-group">
                        <label class="form-label" for="timeset">Timer</label>
                        <select class="form-select" name="timeset" id="timeset">
                        <option selected="" value="1">1 detik</option>
                        <option value="2">2 detik</option>
                        <option value="3">3 detik</option>
                        </select>
                  </div>
                     <div class="form-group">
                        <input class="form-control" type="text" id="time" name="schedule">
                     </div>
                  <button type="submit" id="send" class="btn btn-primary">Send</button>
               </form>
            </div>
      </div>
   </div>
   <div class="col-sm-12 col-lg-4" id="rules">
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


    <script>
   $('#time').datetimepicker();
      $.ajax('http://127.0.0.1:5100/blast/connection', {
         type: 'POST',  // http method
         contentType: 'application/json',
         crossDomain: true,
         success: function (data, status, xhr) {
            // $('p').append('status: ' + status + ', data: ' + data);
            console.log(data['connection']);
            if (data['connection'] == "CONNECTED") {
               $('#log').css("display", "none");
               console.log(data['connection']);
            }
         },
         error: function (jqXhr, textStatus, errorMessage) {
            console.log(errorMessage);

         }
      });

      const socket = io('127.0.0.1:5100');
      console.log(socket);
      socket.on("wa_blast_qr", (data) => {
        console.log(data);
        document.getElementById("qr").src = data;
      });
      var logsEl = $("#logs");
      socket.on("wa_blast_log", (data) => {
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
