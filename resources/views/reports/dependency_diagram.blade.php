<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<div id="cy" style="font-family: helvetica; font-size: 14px; width: 100%; height:100%; position: absolute; left: 0; top:0; z-index: 999;">

</div>
<script>

    window.addEventListener('load', function () {
        cytoscape.use(dagre);
        var cy = (window.cy = cytoscape({
            container: document.getElementById("cy"),

            boxSelectionEnabled: false,
            autounselectify: true,

            layout: {
                name: "dagre"
            },

            style: [
                {
                    selector: "node",
                    style: {
                        content: "data(id)",
                        "text-opacity": 0.5,
                        "text-valign": "center",
                        "text-halign": "right",
                        "background-color": "#11479e"
                    }
                },

                {
                    selector: "edge",
                    style: {
                        "curve-style": "bezier",
                        width: 4,
                        "target-arrow-shape": "triangle",
                        "line-color": "#9dbaea",
                        "target-arrow-color": "#9dbaea"
                    }
                }
            ],

            elements: {
                nodes: [
                    { data: { id: "n0" } },
                    { data: { id: "n1" } },
                    { data: { id: "n2" } },
                    { data: { id: "n3" } },
                    { data: { id: "n4" } },
                    { data: { id: "n5" } },
                    { data: { id: "n6" } },
                    { data: { id: "n7" } },
                    { data: { id: "n8" } },
                    { data: { id: "n9" } },
                    { data: { id: "n10" } },
                    { data: { id: "n11" } },
                    { data: { id: "n12" } },
                    { data: { id: "n13" } },
                    { data: { id: "n14" } },
                    { data: { id: "n15" } },
                    { data: { id: "n16" } }
                ],
                edges: [
                    { data: { source: "n0", target: "n1" } },
                    { data: { source: "n1", target: "n2" } },
                    { data: { source: "n1", target: "n3" } },
                    { data: { source: "n4", target: "n5" } },
                    { data: { source: "n4", target: "n6" } },
                    { data: { source: "n6", target: "n7" } },
                    { data: { source: "n6", target: "n8" } },
                    { data: { source: "n8", target: "n9" } },
                    { data: { source: "n8", target: "n10" } },
                    { data: { source: "n11", target: "n12" } },
                    { data: { source: "n12", target: "n13" } },
                    { data: { source: "n13", target: "n14" } },
                    { data: { source: "n13", target: "n15" } }
                ]
            }
        }));

    })

</script>


</body>
</html>

