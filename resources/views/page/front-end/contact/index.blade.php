@extends('layout.app')

@section('scripts')

  @if (Session::has('message1'))
    <script type="application/javascript">
      swal({
        icon: 'success',
        text: "<?= Session::get('message1') ?>",
      });
    </script>
  @endif
  @if (Session::has('message2'))
    <script type="application/javascript">
      swal({
        icon: 'error',
        text: "<?= Session::get('message2') ?>",
      });
    </script>
  @endif

@endsection

@section('content')

  <style>
    .profile {
      padding: 3%;
      margin-top: 3%;
      margin-bottom: 3%;
      border-radius: 0.5rem;
      background: #fff;
    }

    .accordion a {
      position: relative;
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
      -webkit-flex-direction: column;
      -ms-flex-direction: column;
      flex-direction: column;
      width: 100%;
      padding: 1rem 3rem 1rem 1rem;
      color: #7288a2;
      font-size: 1.15rem;
      font-weight: 400;
      border-bottom: 1px solid #e5e5e5;
    }

    .accordion a:hover,
    .accordion a:hover::after {
      cursor: pointer;
      color: #03b5d2;
    }

    .accordion a:hover::after {
      border: 1px solid #03b5d2;
    }

    .accordion a.active {
      color: #03b5d2;
      border-bottom: 1px solid #03b5d2;
    }

    .accordion a::after {
      font-family: 'Ionicons';
      content: '\f218';
      position: absolute;
      float: right;
      right: 1rem;
      font-size: 1rem;
      color: #7288a2;
      padding: 5px;
      width: 30px;
      height: 30px;
      -webkit-border-radius: 50%;
      -moz-border-radius: 50%;
      border-radius: 50%;
      border: 1px solid #7288a2;
      text-align: center;
    }

    .accordion a.active::after {
      font-family: 'Ionicons';
      content: '\f209';
      color: #03b5d2;
      border: 1px solid #03b5d2;
    }

    .accordion .content {
      opacity: 0;
      padding: 0 1rem;
      max-height: 0;
      border-bottom: 1px solid #e5e5e5;
      overflow: hidden;
      clear: both;
      -webkit-transition: all 0.2s ease 0.15s;
      -o-transition: all 0.2s ease 0.15s;
      transition: all 0.2s ease 0.15s;
    }

    .accordion .content p {
      font-size: 1rem;
      font-weight: 300;
    }

    .accordion .content.active {
      opacity: 1;
      padding: 1rem;
      max-height: 100%;
      -webkit-transition: all 0.35s ease 0.15s;
      -o-transition: all 0.35s ease 0.15s;
      transition: all 0.35s ease 0.15s;
    }

    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }
  </style>

  <div class="container">
    <div class="container profile">
      <div class="col-12">
        <br>

        <h1>Waar kunnen wij u mee helpen?</h1>
        <hr>
        {{--Contact Form--}}
        <div class="col-12 col-md-6">
          <form class="form-horizontal" method="POST"
                action="{{ action('ContactController@sendEmail') }}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="Name">Name: </label>
              <input type="text" class="form-control" id="name" placeholder="Your name" name="name"
                     required>
            </div>

            <div class="form-group">
              <label for="email">Email: </label>
              <input type="text" class="form-control" id="email" placeholder="john@example.com"
                     name="email" required>
            </div>

            <div class="form-group">
              <label for="message">Message: </label>
              <textarea type="text" class="form-control luna-message" id="message"
                        placeholder="Type your message here" name="message" required></textarea>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary" value="Send">Send</button>
            </div>
          </form>
        </div>

        <br><br><br><br>

        {{--FAQ--}}
        <h1>Frequently Asked Questions</h1>
        <hr>

        <div class="tab">
          <button class="tablinks" onclick="openArea(event, 'Tab1')">Most asked</button>
          <button class="tablinks" onclick="openArea(event, 'Tab2')">Products</button>
          <button class="tablinks" onclick="openArea(event, 'Tab3')">Profile</button>
          <button class="tablinks" onclick="openArea(event, 'Tab4')">Delivery</button>
          <button class="tablinks" onclick="openArea(event, 'Tab5')">Contact</button>
        </div>

        {{--Most asked--}}
        <div class="accordion">
          <div id="Tab1" class="tabcontent">
            <div class="accordion-item">
              <a>Where do you deliver?</a>
              <div class="content">
                <p>We deliver anywhere in the world.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>How much do you charge for delivery?</a>
              <div class="content">
                <p>The delivery costs depends on the type of delivery service. Below are the options
                  we give you:</p>
                <p>POSTNL: €1,99.</p>
                <p>UPS: €3,99.</p>
                <p>DHP: €2,99.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>Can I make a wishlist for later use?</a>
              <div class="content">
                <p>Yes you can! You can add products to your Favorites so you can easily find them
                  again.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>Do you give products away for free?</a>
              <div class="content">
                <p>While some products are free, we do not give them away for free. This is because
                  of the delivery costs.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>I do not see any address when purchasing a product.</a>
              <div class="content">
                <p>This is probably because you did not create an address yet. How to create an
                  address:</p>
                <p>1. Go to your profile</p>
                <p>2. Go to the tab <i>"Addresses"</i></p>
                <p>3. Click on <i>"Create"</i> and add your address.</p>
              </div>
            </div>
            <br>
          </div>
        </div>

        {{--Products--}}
        <div class="accordion">
          <div id="Tab2" class="tabcontent">
            <div class="accordion-item">
              <a>What do you sell?</a>
              <div class="content">
                <p>We sell videogames with the best prices!</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>Are there any age restrictions?</a>
              <div class="content">
                <p>Nope. It does not matter if you are a child or an adult. Everybody is the same to
                  us.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>Do you give products away for free?</a>
              <div class="content">
                <p>While some products are free, we do not give them away for free. This is because
                  of the delivery costs.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>Do you update your products?</a>
              <div class="content">
                <p>Absolutely! We update our products so we can keep the best prices and keep you
                  up-to-date with new products as well!</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>How many products do you sell?</a>
              <div class="content">
                <p>A lot.</p>
              </div>
            </div>
            <br>
          </div>
        </div>

        {{--Profile--}}
        <div class="accordion">
          <div id="Tab3" class="tabcontent">
            <div class="accordion-item">
              <a>I do not see any address when purchasing a product.</a>
              <div class="content">
                <p>This is probably because you did not create an address yet. How to create an
                  address:</p>
                <p>1. Go to your profile</p>
                <p>2. Go to the tab <i>"Addresses"</i></p>
                <p>3. Click on <i>"Create"</i> and add your address.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>How do I create an account?</a>
              <div class="content">
                <p>How to create an account:</p>
                <p>1. Click on the button <i>"Register"</i></p>
                <p>2. Enter your credentials and click on <i>"Register"</i></p>
                <p>3. Your account is created and you can now login</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>Is it possible to view orders I made in the past?</a>
              <div class="content">
                <p>Yes! Under the tab <i>"Order History"</i> on your profile page. You can see every
                  order you made.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>I lost my password. What now?</a>
              <div class="content">
                <p>You can click on the link <i>"Forget password?"</i> and follow the steps.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>How can I edit my profile page?</a>
              <div class="content">
                <p>You can not.</p>
              </div>
            </div>
            <br>
          </div>
        </div>

        {{--Delivery--}}
        <div class="accordion">
          <div id="Tab4" class="tabcontent">
            <div class="accordion-item">
              <a>Where do you deliver?</a>
              <div class="content">
                <p>We deliver anywhere in the world.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>How much do you charge for delivery?</a>
              <div class="content">
                <p>The delivery costs depends on the type of delivery service. Below are the options
                  we give you:</p>
                <p>POSTNL: €1,99.</p>
                <p>UPS: €3,99.</p>
                <p>DHP: €2,99.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>When will I receive my order?</a>
              <div class="content">
                <p>You will receive your order within 24 hours after the purchase.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>Can I cancel my order?</a>
              <div class="content">
                <p>It is not possible to cancel your order. We do not accept this kind of
                  behaviour</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>I forgot to select an product. Is it possible to include it in the order I
                previously made?</a>
              <div class="content">
                <p>It is. Order the product you forgot within 30 minutes of your previous order and
                  we will send it along with the other products.</p>
              </div>
            </div>
            <br>
          </div>
        </div>

        {{--Contact--}}
        <div class="accordion">
          <div id="Tab5" class="tabcontent">
            <div class="accordion-item">
              <a>Do I need to be logged in to enter the contact form?</a>
              <div class="content">
                <p>No. Because of the email you fill in, we can easily contact you.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>I can not find my question.</a>
              <div class="content">
                <p>Can not find your question? Ask it with the contact form!</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>What is your response time with the contact form?</a>
              <div class="content">
                <p>Our costumer service is open 24/7. We usually respond within seconds, if not
                  minutes (if we are busy)</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>Can I add questions to the FAQ?</a>
              <div class="content">
                <p>That is not possible.</p>
              </div>
            </div>
            <div class="accordion-item">
              <a>Are you aliens?</a>
              <div class="content">
                <p>We are not aliens, while we may seem supernatural with our prices and fast
                  delivery.</p>
              </div>
            </div>
            <br>
          </div>
        </div>

        <br><br>
        <br><br>

        <script>
          const items = document.querySelectorAll(".accordion a");

          function toggleAccordion() {
            this.classList.toggle('active');
            this.nextElementSibling.classList.toggle('active');
          }

          items.forEach(item => item.addEventListener('click', toggleAccordion));

          function openArea(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
          }
        </script>

      </div>
    </div>
  </div>

@endsection