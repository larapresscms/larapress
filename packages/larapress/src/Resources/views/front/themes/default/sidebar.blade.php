
<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">Search</div>
        <div class="card-body">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
            </div>
        </div>
    </div>
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <ul class="list-unstyled mb-0">
                        <li><a href="#!">Web Design</a></li>
                        <li><a href="#!">HTML</a></li>
                        <li><a href="#!">Freebies</a></li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="list-unstyled mb-0">
                        <li><a href="#!">JavaScript</a></li>
                        <li><a href="#!">CSS</a></li>
                        <li><a href="#!">Tutorials</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Side widget-->
    <div class="card mb-4">
        <div class="card-header">Feedback</div>
        <div class="card-body">

        @if(session()->has('message'))
        <br/>
        <div class="alert alert-success" role="alert">
            {{session('message')}}
        </div>
        @endif

        @if(session()->has('messageDestroy'))<br/>
        <div class="alert alert-danger" role="alert">
            {{session('messageDestroy')}}
        </div>
        @endif

        <form action="{{ url('/feedbacks') }}" method="post">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="fname" class="form-control" id="exampleInputEmail1" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Subject</label>
                <input type="text" name="fsubject" class="form-control" id="exampleInputEmail1" required> 
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="femail" class="form-control" id="exampleInputEmail1" required> 
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Phone</label>
                <input type="text" class="form-control" name="fphone" id="exampleInputEmail1" required> 
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea type="text" name="fmessage" class="form-control" ></textarea>
            </div>
            <input type="hidden" name="mailurl" value="{{url()->current()}}"/>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>

   

        </div>
    </div>
</div>
