<x-layout>
    <x-sidenav>
      @include('partials._search-ticket')

      <div class="tabset">
        <!-- Tab 1 -->
        <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
        <label for="tab1">Märzen</label>
        <!-- Tab 2 -->
        <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
        <label for="tab2">Rauchbier</label>
        <!-- Tab 3 -->
        <input type="radio" name="tabset" id="tab3" aria-controls="dunkles">
        <label for="tab3">Dunkles Bock</label>
        
        <div class="tab-panels">
          <section id="marzen" class="tab-panel">
            <h2>6A. Märzen</h2>
            <p><strong>Overall Impression:</strong> An elegant, malty German amber lager with a clean, rich, toasty and bready malt flavor, restrained bitterness, and a dry finish that encourages another drink. The overall malt impression is soft, elegant, and complex, with a rich aftertaste that is never cloying or heavy.</p>
            <p><strong>History:</strong> As the name suggests, brewed as a stronger “March beer” in March and lagered in cold caves over the summer. Modern versions trace back to the lager developed by Spaten in 1841, contemporaneous to the development of Vienna lager. However, the Märzen name is much older than 1841; the early ones were dark brown, and in Austria the name implied a strength band (14 °P) rather than a style. The German amber lager version (in the Viennese style of the time) was first served at Oktoberfest in 1872, a tradition that lasted until 1990 when the golden Festbier was adopted as the standard festival beer.</p>
        </section>
          <section id="rauchbier" class="tab-panel">
            <h2>6B. Rauchbier</h2>
            <p><strong>Overall Impression:</strong>  An elegant, malty German amber lager with a balanced, complementary beechwood smoke character. Toasty-rich malt in aroma and flavor, restrained bitterness, low to high smoke flavor, clean fermentation profile, and an attenuated finish are characteristic.</p>
            <p><strong>History:</strong> A historical specialty of the city of Bamberg, in the Franconian region of Bavaria in Germany. Beechwood-smoked malt is used to make a Märzen-style amber lager. The smoke character of the malt varies by maltster; some breweries produce their own smoked malt (rauchmalz).</p>
          </section>
          <section id="dunkles" class="tab-panel">
            <h2>6C. Dunkles Bock</h2>
            <p><strong>Overall Impression:</strong> A dark, strong, malty German lager beer that emphasizes the malty-rich and somewhat toasty qualities of continental malts without being sweet in the finish.</p>
            <p><strong>History:</strong> Originated in the Northern German city of Einbeck, which was a brewing center and popular exporter in the days of the Hanseatic League (14th to 17th century). Recreated in Munich starting in the 17th century. The name “bock” is based on a corruption of the name “Einbeck” in the Bavarian dialect, and was thus only used after the beer came to Munich. “Bock” also means “Ram” in German, and is often used in logos and advertisements.</p>
          </section>
        </div>
        
      </div>
      
      <p><small>Source: <cite><a href="https://www.bjcp.org/stylecenter.php">BJCP Style Guidelines</a></cite></small></p>
        {{-- <hr style="width: 100%; margin-bottom: 0; background-color: #C4C4C4; border: 0.1px solid #C4C4C4;
        transform: rotate(0.08deg); ">
        
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">CATEGORY</th>
              <th scope="col">REQUESTER</th>
              <th scope="col">DESCRIPTION</th>
              <th scope="col">DATE</th>
              <th scope="col">STATUS</th>
              <th scope="col">ASSIGNEE</th>
            </tr>
          </thead>
          <tbody>
            @unless(count($tickets) == 0)

            @foreach($tickets as $ticket)
              <tr>
                <td>{{$ticket->id}}</td>
                <td>{{$ticket->categ->name}}</td>
                <td scope="row" style="word-break: break-all;">
                  <b>{{$ticket->student->LName}}, {{$ticket->student->FName}}</b>
                  <br>{{$ticket->student->email}}
                </td>
                <td>{{$ticket->description}}</td>
                <td>{{$ticket->dateSubmitted}}</td>
                @if($ticket->status == "Pending")
                  <td>Ongoing</td>
                @else
                  <td>{{$ticket->status}}</td>
                @endif
                @if (count($ticket->reopens) != 0)
                  <td style="word-break: break-all;">
                    {{$ticket->user->email}}
                    @foreach($ticket->reopens as $reopen)
                      <br>{{$reopen->user->email}}
                    @endforeach
                  </td>
                @else
                  <td style="word-break: break-all;">{{$ticket->user->email}}</td>
                @endif
                <td>
                  <a href="/tickets/{{$ticket->id}}"><i class='bx-fw bx bxs-show bx-sm'></i>View</a>
                </td>
              </tr>

              
            @endforeach

            @else
              <p>No Tickets Found</p>
        
            @endunless
            
          </tbody>
        </table>
      </div>

      <div class="paginate">
        {{ $tickets->links('pagination::bootstrap-5') }}
      </div>
    </div> --}}
  </x-sidenav>
</x-layout>