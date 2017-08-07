module.exports = function ($http, $httpParamSerializer) {
    return {
        search(name, success, error) {
            let queryParamaters = {
                s: name,
                r: 'json'
            };

            $http.get('https://www.omdbapi.com/?apikey=b8272f7d&' + $httpParamSerializer(queryParamaters), {
            }).success(success).error(error);
        },

        details(imdb, success, error) {
            let queryParamaters = {
                i: imdb,
                plot: 'full',
                r: 'json'
            };

            $http.get('https://www.omdbapi.com/?apikey=b8272f7d&' + $httpParamSerializer(queryParamaters), {
            }).success(success).error(error);
        },
    };
};
