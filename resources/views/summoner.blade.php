@extends('layout')

@section('title', 'summoner')

@section('content')

    <script>
    </script>
    <?php /** @var API\LeagueAPI\Objects\Summoner $summoner
     * @var API\LeagueAPI\Objects\MatchById $matchById[]
     * @var API\LeagueAPI\Objects\StaticData\StaticProfileIconData $icons
     * @var API\LeagueAPI\Objects\StaticData\StaticChampionList $champions
     * @var API\LeagueAPI\Objects\StaticData\StaticItemList $items
     * @var API\LeagueAPI\Objects\StaticData\StaticRunesReforgedList $runes
     * @var API\LeagueAPI\Objects\StaticData\StaticSummonerSpellList $summonerSpells
     * @var API\LeagueAPI\Objects\StaticData\
     */ ?>
    <div class="Summoner">
        <div class="SummonerInfo">
            <h1>Some info about the summoner</h1>
            <p> {{ $summoner->name }} </p>
            <img src="/img/profileicon/{{$icons->data[$summoner->profileIconId]->image->full}}" alt="image">
            <br>
        </div>
        <div class="Menu">
            <h1>Some menus to choose from for different stats</h1>
            <br>
            <dl class="MenuList">
                <dd id="Summary" class="d-inline-block">
                    <a href='/summoner?name={{ $summoner->name }}'>Summary</a>
                </dd>
                <dd id="Champions" class="d-inline-block">
                    <a href='#'>Champions</a>
                </dd>
                <dd id="Leagues" class="d-inline-block">
                    <a href="#">Leagues</a>
                </dd>
                <dd id="LiveGame" class="d-inline-block">
                    <a href="#">Live Game</a>
                </dd>
            </dl>
        </div>
        <div class="ActualStats">
            <div id="Summary" style="display: block">
                <p>Some Summary</p>
                <div class="SideContent">
                    KDA:  {{ ($matchById[0]->participants[0]->stats->kills + $matchById[0]->participants[0]->stats->assists) / $matchById[0]->participants[0]->stats->deaths  }}
                </div>
                <div class="ActualContent">
                    <div class="GamesContainer">
                        <div class="Header">

                        </div>
                        <div class="Content">
                            <div class="GameAverageBox">

                            </div>
                            <div class="GameList">

                            </div>
                            <div class="MoreGamesButton">
                                <a href="#" onclick = "" class="btn btn-danger">More games?</a>
	                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id="Champions" style="display: none">
                <p>Some Champions</p>
            </div>
            <div id="Leagues" style="display: none">
                <p>Some Leagues</p>
            </div>
            <div id="LiveGame"  style="display: none">
                <p>Some Live Game</p>
            </div>
            <h1>Actual stats</h1>
            <p>{{ "game ID: ". $matchById[0]->gameId }}</p>
        </div>
    </div>

@endsection
