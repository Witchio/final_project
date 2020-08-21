<!-- extends from template-->
<section>
    <!-- This is the parent for the charts and the posts -->
    <div id="charts">
        <!--To reshaphe charts modify the canvas and the container both or won't work-->
        <article style="max-height:1000px;max-width:1000px">

            <canvas id="chart" style="max-height:1000px;max-width:1000px"></canvas>
            <!-- chart 1  -->
        </article>


        <article>
            <!-- chart2 -->
            <canvas id="continent"></canvas>
        </article>
    </div>


    <div id="posts">
        <!-- displays top posts -->
        <h2>Trending Community Posts</h2>
        @foreach($posts as $post)
        <p>Title : {{ $post->title }}</p>
        <p>Image : </p>
        <img src="{{ asset("images/$post->image")}}" alt="">
        <p>Content : {{ $post->content }}</p>
        <p>Likes : </p>
        <p>Comments : {{ $post->comments }}</p>
        @foreach($post->comments as $comment)
        {{$comment->content}}

        @endofreach
        <a href="/posts/{{$post->id}}">Read hole Post</a><br>
        <hr>
        @endforeach
    </div>

</section>

<section>
    <!-- Rss feed, squeleton for that tbd -->
</section>

<!--Chart.js-->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<!--Label Plugin-->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.js"></script>
<!--Scripts-->
<script src="charts/homeChart.js"></script>
<script src="charts/continent.js"></script>