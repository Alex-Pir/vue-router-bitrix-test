<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
    \Bitrix\Main\UI\Extension::load("lightgallery");
?>
    <div class="demo-gallery">
        <div id="video-gallery">
            <a
                    data-lg-size="1280-720"
                    data-src="//www.youtube.com/watch?v=egyIeygdS_E"
                    data-poster="https://img.youtube.com/vi/egyIeygdS_E/maxresdefault.jpg"
                    data-sub-html="<h4>Visual Soundscapes - Mountains | Planet Earth II | BBC America</h4><p>On the heels of Planet Earth II’s record-breaking Emmy nominations, BBC America presents stunning visual soundscapes from the series' amazing habitats.</p>"
            >
                <img
                        width="300"
                        height="100"
                        class="img-responsive"
                        src="https://img.youtube.com/vi/egyIeygdS_E/maxresdefault.jpg"
                />
            </a>
        </div>
    </div>
<script>
    $(document).ready(function() {
        lightGallery(document.getElementById('video-gallery'), {
            plugins: [lgThumbnail, lgVideo],
            speed: 500,
            thumbnail: true,
            youTubePlayerParams: {
                modestbranding : 1,
                showinfo : 0,
                controls : 0
            }});
    });

</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>