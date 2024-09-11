<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Fond de page gris */
        body {
            background-color: #f0f0f0;
            font-family: Figtree, ui-sans-serif, system-ui, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Centre les éléments dans la div */
        div {
            text-align: center;
            margin-top: 5px;
        }

        /* Style du titre */
        h1 {
            font-size: 2.5rem;
            color: black;
        }

        /* Style des labels */
        label {
            font-size: 1.2rem;
            color: #333;
        }

        /* Input style */
        input[type="text"] {
            font-size: 1rem;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 250px;
        }

        /* Bouton standard */
        button {
            font-size: 1rem;
            padding: 10px 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #e0e0e0;
            cursor: pointer;
            margin-right: 10px;
            min-width: 100px;
            text-align: center;
        }

        /* Effet hover sur les boutons standards sauf ceux "Done" */
        button:hover:not(.button-done) {
            background-color: rgb(69, 69, 155);
            color: white;
        }

        /* Style pour les boutons désactivés (tâches complètes) */
        .button-done {
            background-color: green;
            color: white;
            border: none;
        }

        /* Changement de couleur et texte au survol */
        .button-done:hover {
            background-color: #f28b82; /* Rouge pastel */
            color: white;
        }

        /* Centrer les éléments */
        .list-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        /* Aligner les boutons et les textes */
        .list {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 400px;
        }

        .list p {
            margin: 0;
        }
    </style>
</head>

<body>

    <div>
        <h1>To Do List</h1></br>

        <!-- Formulaire d'ajout -->
        <div style="margin-top: 10px; margin-bottom: 10px;">
            <form method="POST" action="{{ route('saveItemRoute') }}">
                {{ csrf_field() }}
                <label for="newItem"> Nouvelle tâche </label>
                <input type="text" name="newItem">
                <button type="submit"> + </button>
            </form>
        </div>

        <!-- Conteneur de la liste aligné au centre pour les tâches incomplètes -->
        <div class="list-container">
            <h2> Non terminées </h2>
            @foreach ($incompleteItems as $listItem)
                <div class="list">
                    <p>{{ $listItem->name }}</p>
                    <form method="POST" action="{{ route('markCompleteRoute', $listItem->id) }}">
                        {{ csrf_field() }}
                        <button type="submit">Done</button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Conteneur de la liste aligné au centre pour les tâches complètes -->
        <div class="list-container">
            <h2> Terminées </h2>
            @foreach ($completedItems as $listItem)
                <div class="list">
                    <p><s>{{ $listItem->name }}</s></p>
                    <form method="POST" action="{{ route('markIncompleteRoute', $listItem->id) }}">
                        {{ csrf_field() }}
                        <!-- Bouton vert qui change le texte et la couleur au survol -->
                        <button type="submit" class="button-done"
                                onmouseover="this.innerHTML='Undone'; this.style.backgroundColor='#f28b82';"
                                onmouseout="this.innerHTML='Done'; this.style.backgroundColor='green';">
                            Done
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
