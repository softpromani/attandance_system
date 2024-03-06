@extends('frontend.includes.head')
@extends('frontend.includes.loader')
@extends('frontend.includes.footer')
<div class="card card-style">
    <div class="content mb-0 ">
    <h3>Teacher Registration</h3>
    <div class="row">
    <div class="input-style has-borders has-icon validate-field mb-4 col-sm-4">
    <i class="fa fa-user"></i>
    <input type="name" class="form-control validate-name" id="form1" placeholder="Name">
    <label for="form1" class="color-highlight">Enter Your First Name</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-4">
    <input type="text" class="form-control validate-text" id="form2" placeholder="email">
    <label for="form2" class="color-highlight">Enter Your Last Name</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>

    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-4">
    <input type="password" class="form-control validate-text" id="form3" placeholder="Password">
    <label for="form3" class="color-highlight">Password</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-4">
    <input type="url" class="form-control validate-text" id="form44" placeholder="Website">
    <label for="form44" class="color-highlight">Website</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style has-borders no-icon validate-field mb-4 col-sm-4">
    <input type="tel" class="form-control validate-text" id="form4" placeholder="Phone">
    <label for="form4" class="color-highlight">Phone</label>
    <i class="fa fa-times disabled invalid color-red-dark"></i>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <em>(required)</em>
    </div>
    <div class="input-style has-borders no-icon mb-4 col-sm-4">
    <label for="form5" class="color-highlight">Select A Value</label>
    <select id="form5">
    <option value="default" disabled="" selected="">Select a Value</option>
    <option value="iOS">iOS</option>
    <option value="Linux">Linux</option>
    <option value="MacOS">MacOS</option>
    <option value="Android">Android</option>
    <option value="Windows">Windows</option>
    </select>
    <span><i class="fa fa-chevron-down"></i></span>
    <i class="fa fa-check disabled valid color-green-dark"></i>
    <i class="fa fa-check disabled invalid color-red-dark"></i>
    <em></em>
    </div>
    <div class="input-style has-borders no-icon mb-4 col-sm-4">
    <textarea id="form7" placeholder="Enter your message"></textarea>
    <label for="form7" class="color-highlight">Enter your Message</label>
    <em class="mt-n3">(required)</em>
    </div>

    <div class="input-style has-borders no-icon mb-4 col-sm-4">
    <textarea id="form7" placeholder="Enter your message"></textarea>
    <label for="form7" class="color-highlight">Enter your Message</label>
    <em class="mt-n3">(required)</em>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="input-style has-borders no-icon mb-4 col-sm-4">
                    <input type="date" class="form-control" id="form7" name="date_field">
                    <label for="form7" class="color-highlight">Enter your Message</label>
                    <em class="mt-n3">(required)</em>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>

    </div>
@extends('frontend.includes.foot')
