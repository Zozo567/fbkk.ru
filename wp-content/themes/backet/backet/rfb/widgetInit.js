/********************************************************************************************/
/*   Инициализация виджета                                                                 */
/*   Виджеты: competition-profile, game-widget, team-profile, player-profile, coach-profile */
/*   Установка аттрибутов виджета в соответствии с параметрами запроса                      */
/********************************************************************************************/

var getParam = function (p, def) {
    var x = document.location.search.indexOf(p + "=");
    if (x < 0) return def;
    var res = document.location.search.substr(x + p.length + 1);
    if (res.indexOf("&") < 0) return res;
    return res.substr(0, res.indexOf("&"));
};
var widgetTags = ['competition-profile', 'game-widget', 'team-profile', 'player-profile', 'coach-profile'];
var params = [
    { param: 'apiUrl', attr: 'api-url' },
    { param: 'lang', attr: 'lang' },
    { param: 'teamId', attr: 'team-id' },
    { param: 'personId', attr: 'person-id' },
    { param: 'compId', attr: 'competition-id' },
    { param: 'compId', attr: 'comp-id' },
    { param: 'gameId', attr: 'game-id' }
];
for (var i = 0; i < widgetTags.length; i++) {
    var widgets = document.getElementsByTagName(widgetTags[i]);
    if (widgets !== null && widgets.length > 0) {
        var widget = widgets[0];
        for (var j = 0; j < params.length; j++) {
            var value = getParam(params[j].param, '---');
            if (value !== '---') {
                widget.setAttribute(params[j].attr, value);
            }
        }
    }
}

RFBWidgets.playerPageUrl = '/rfb/player.html?personId={personId}&apiUrl={apiUrl}&compId={compId}&lang={lang}';
RFBWidgets.teamPageUrl = '/rfb/team.html?teamId={teamId}&apiUrl={apiUrl}&compId={compId}&lang={lang}';
RFBWidgets.compPageUrl = '/rfb/competition.html?compId={compId}&apiUrl={apiUrl}&lang={lang}';
RFBWidgets.gamePageUrl = '/rfb/game.html?gameId={gameId}&apiUrl={apiUrl}&lang={lang}';
RFBWidgets.coachPageUrl = '/rfb/coach.html?personId={personId}&apiUrl={apiUrl}&lang={lang}';

RFBWidgets.init();
