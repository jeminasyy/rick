<x-layout>
    <div id="bg-color1">
    
        <div id="container1">
           
            <div id="sidenav1">
                <h2 style="margin-left:40px;">Filter</h2>
                <hr style="width: 1450px; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
                transform: rotate(0.08deg); ">
                <h4 style="color:#605D5D; margin-top:10%; margin-left:12%; margin-bottom: 7%;">Date - oldest</h4>
                <h4 style="color:#605D5D; margin-left:12%;">Date - newest</h4>
                <hr style="margin-left:6%; width: 320px; background-color: #C4C4C4; border: 0.001px solid #C4C4C4;
                transform: rotate(0.08deg); ">
            </div>
            
            <div id="sidenav2">
                <h2 style="margin-left:10px;">Tickets Submitted</h2>
                <br>
                <h4 style="margin-left:15px;">3 tickets</h4>
                <hr style="width: 1050px; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
                transform: rotate(0.08deg); ">
    
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">TICKET</th>
                        <th scope="col">TICKET #</th>
                        <th scope="col">DATE</th>
                        <th scope="col">STATUS</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Request for Form xxx</th>
                        <td>12345</td>
                        <td>02/17/22</td>
                        <td>Closed</td>
                        <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="border-radius: 13px; background-color: #F8CA0A; 
                        border: 0.1px solid#F8CA0A; color:black; width: 70px; height:25px; text-align: center;">Reopen</button>
                        
                        <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color:#EAF0F2;">
                            <h1 class="modal-title" id="exampleModalLongTitle" style="text-align:center; font-weight: bolder;">Reopen Ticket</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body" style="background-color:#EAF0F2;">
                            <h4 style="font-weight: bold;">Ticket Number: 1234</h4> 
                            <h4 style="font-weight: bold;">Ticket Description: Request for form xxxx</h4> 
                            <form id="updateeventsform2" class="form-horizontal">
                                <div class="form-group">
                                <label for='areaforinfo' style="font-size: 18px; font-weight: bold; margin-left:2.7%;">Reason for reopening:</label>
                                <textarea class = "form-control" id='areaforinfo' style="margin-left:2.7%; width: 90%;" rows="7" ></textarea>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer" style="background-color:#EAF0F2;">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #FFFFFF;
                            border: 1px solid#F8CA0A;
                            border-radius: 5px; color:#F8CA0A ;" >Cancel</button>
                            <button type="button" class="btn btn-primary" style=" margin-left:2%; background-color: #F8CA0A;
                            border: 1px solid#F8CA0A;
                            border-radius: 5px; color:#000000;">Confirm</button>
                            </div>
                        </div>
                        </div>
                    </div></td>
                      </tr>
                      <tr>
                        <th scope="row">Request for Form xxx</th>
                        <td>12345</td>
                        <td>02/17/22</td>
                        <td>Closed</td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="border-radius: 13px; background-color: #F8CA0A; 
                            border: 0.1px solid#F8CA0A; color:black; width: 70px; height:25px; text-align: center;">Reopen</button>
                            
                            <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#EAF0F2;">
                                <h1 class="modal-title" id="exampleModalLongTitle" style="text-align:center; font-weight: bolder;">Reopen Ticket</h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body" style="background-color:#EAF0F2;">
                                <h4 style="font-weight: bold;">Ticket Number: 1234</h4> 
                                <h4 style="font-weight: bold;">Ticket Description: Request for form xxxx</h4> 
                                <form id="updateeventsform2" class="form-horizontal">
                                    <div class="form-group">
                                    <label for='areaforinfo' style="font-size: 18px; font-weight: bold; margin-left:2.7%;">Reason for reopening:</label>
                                    <textarea class = "form-control" id='areaforinfo' style="margin-left:2.7%; width: 90%;" rows="7" ></textarea>
                                    </div>
                                </form>
                                </div>
                                <div class="modal-footer" style="background-color:#EAF0F2;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #FFFFFF;
                                border: 1px solid#F8CA0A;
                                border-radius: 5px; color:#F8CA0A ;" >Cancel</button>
                                <button type="button" class="btn btn-primary" style=" margin-left:2%; background-color: #F8CA0A;
                                border: 1px solid#F8CA0A;
                                border-radius: 5px; color:#000000;">Confirm</button>
                                </div>
                            </div>
                            </div>
                        </div></td>
                      </tr>
                      <tr>
                        <th scope="row">Request for Form xxx</th>
                        <td>12345</td>
                        <td>02/17/22</td>
                        <td>Closed</td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="border-radius: 13px; background-color: #F8CA0A; 
                            border: 0.1px solid#F8CA0A; color:black; width: 70px; height:25px; text-align: center;">Reopen</button>
                            
                            <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color:#EAF0F2;">
                                <h1 class="modal-title" id="exampleModalLongTitle" style="text-align:center; font-weight: bolder;">Reopen Ticket</h1>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body" style="background-color:#EAF0F2;">
                                <h4 style="font-weight: bold;">Ticket Number: 1234</h4> 
                                <h4 style="font-weight: bold;">Ticket Description: Request for form xxxx</h4> 
                                <form id="updateeventsform2" class="form-horizontal">
                                    <div class="form-group">
                                    <label for='areaforinfo' style="font-size: 18px; font-weight: bold; margin-left:2.7%;">Reason for reopening:</label>
                                    <textarea class = "form-control" id='areaforinfo' style="margin-left:2.7%; width: 90%;" rows="7" ></textarea>
                                    </div>
                                </form>
                                </div>
                                <div class="modal-footer" style="background-color:#EAF0F2;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #FFFFFF;
                                border: 1px solid#F8CA0A;  
                                border-radius: 5px; color:#F8CA0A ;" >Cancel</button>
                                <button type="button" class="btn btn-primary" style=" margin-left:2%; background-color: #F8CA0A;
                                border: 1px solid#F8CA0A;
                                border-radius: 5px; color:#000000;">Confirm</button>
                                </div>
                            </div>
                            </div>
                        </div></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
       
        </div>
    </div>
</x-layout>