app.controller('MenageIndexCtrl', ['$scope', '$http', '$route', '$location', "DTOptionsBuilder", "DTColumnBuilder",
    "DTDefaultOptions", "DTColumnDefBuilder", "$compile", '$rootScope', 'AppFactory', 'Status', 'envService', '$window',
    function ($scope, $http, $route, $location, DTOptionsBuilder, DTColumnBuilder, DTDefaultOptions, DTColumnDefBuilder, $compile, $rootScope, AppFactory, Status, envService, $window) {
        $scope.cb1 = true;
        $(".spinme").show();
        $scope.cercle_disabled = true;
        $scope.commune_disabled = true;
        $scope.village_disabled = true;
        $scope.projets = [];
        $scope.villages = [];
        $scope.communes = [];
        $scope.cercles = [];
        $scope.regions = [];
        $scope.getzoneurl = window.wsurl + '/setting/village_get';
        $http.post($scope.getzoneurl).success(function (response) {
            $(".spinme").hide();
            $scope.AllVillages = response;
            angular.forEach($scope.AllVillages, function (value, key) {
                if (functiontofindIndexByKeyValue($scope.regions, "id", value.commune.cercle.region.id) === -1) {
                    $scope.regions.push(value.commune.cercle.region);
                }
            });
        });


        $scope.cancel = function (region) {
            $("#region").select2('val', '');
            $("#cercle").select2('val', '');
            $("#commune").select2('val', '');
            $("#village").select2('val', '');

            $scope.filtre = [];
            $scope.cercles = [];
            $scope.communes = [];
            $scope.villages = [];

            $scope.filter($scope.filtre);
        };

        $scope.download_csv = function () {
            $window.open(window.wsurl + '/enquete/generate_csv', '_blank');
        };

        var getEnq = function () {return envService.is('production')? 'enq' : 'Enq';};
        var getPrenom = function () {return envService.is('production')? 'prenom' : 'Prenom';};
        var getRegion = function () {return envService.is('production')? 'region' : 'Region';};
        var getCercle = function () {return envService.is('production')? 'cercle' : 'Cercle';};
        var getCommune = function () {return envService.is('production')? 'commune' : 'Commune';};
        var getVill = function () {return envService.is('production')? 'vill' : 'Vill';};

        $scope.region_change = function (region) {
            $scope.cercle_disabled = false;
            var cercle_id = [];
            var cercle_intermediaire = [];

            if ($scope.cercle != undefined) {
                angular.forEach($scope.cercle, function (value, key) {
                    var search = functiontofindIndexByKeyValue($scope.region, "id", value.region.id);
                    if (search !== -1) {
                        cercle_id.push(value.id);
                        cercle_intermediaire.push(value);
                    }
                });
            }
            $scope.cercles = [];

            $("#cercle").select2('val', '');

            angular.forEach($scope.AllVillages, function (value, key) {
                exist_region = functiontofindIndexByKeyValue(region, "id", value.commune.cercle.region.id);
                exist_cercle = functiontofindIndexByKeyValue($scope.cercles, "id", value.commune.cercle.id);
                if (exist_region !== -1 && exist_cercle === -1) {
                    $scope.cercles.push(value.commune.cercle);
                }
            });
            $("#cercle").select2('val', cercle_id);
            $scope.cercle = cercle_intermediaire;
            $scope.cercle_change($scope.cercle);
        };

        $scope.cercle_change = function (cercle) {
            if (cercle.length != 0) {
                $scope.commune_disabled = false;
            }

            var commune_id = [];
            var commune_intermediaire = [];

            if ($scope.commune != undefined) {
                angular.forEach($scope.commune, function (value, key) {
                    var search = functiontofindIndexByKeyValue($scope.cercle, "id", value.cercle.id);

                    if (search !== -1) {
                        commune_id.push(value.id);
                        commune_intermediaire.push(value);
                    }
                });
            }
            $scope.communes = [];

            $("#commune").select2('val', '');
            angular.forEach($scope.AllVillages, function (value, key) {
                exist_cercle = functiontofindIndexByKeyValue(cercle, "id", value.commune.cercle.id);
                exist_commune = functiontofindIndexByKeyValue($scope.communes, "id", value.commune.id);
                if (exist_cercle !== -1 && exist_commune === -1) {
                    $scope.communes.push(value.commune);
                }
            });
            $("#commune").select2('val', commune_id);
            $scope.commune = commune_intermediaire;
            $scope.commune_change($scope.commune);
        };

        $scope.commune_change = function (commune) {
            if (commune.length != 0) {
                $scope.village_disabled = false;
            }

            var vilage_id = [];
            var village_intermediaire = [];

            if ($scope.village != undefined) {
                angular.forEach($scope.village, function (value, key) {
                    var search = functiontofindIndexByKeyValue($scope.commune, "id", value.commune.id);
                    if (search !== -1) {
                        vilage_id.push(value.id);
                        village_intermediaire.push(value);
                    }
                });
            }
            $scope.villages = [];
            $("#village").select2('val', '');

            if (commune != undefined) {
                angular.forEach($scope.AllVillages, function (value, key) {
                    exist_commune = functiontofindIndexByKeyValue(commune, "id", value.commune.id);
                    exist_village = functiontofindIndexByKeyValue($scope.villages, "id", value.id);
                    if (exist_commune !== -1 && exist_village === -1) {
                        $scope.villages.push(value);

                    }
                });
            }
            $scope.village = village_intermediaire;
            $("#village").select2('val', vilage_id);
        };

        function functiontofindIndexByKeyValue(arraytosearch, key, valuetosearch) {
            for (var i = 0; i < arraytosearch.length; i++) {
                if (arraytosearch[i][key] == valuetosearch) {
                    return i;
                }
            }
            return -1;
        }

        $scope.cb1 = true;

        var table;
        var selectedItems = [2,1];
        var s = $scope;
        $(document).ready(function () {
            console.log(s);
            $scope.toggleAll = function(selectAll, selectedItems) {
                alert("test");

                for (var id in selectedItems) {
                    if (selectedItems.hasOwnProperty(id)) {
                        selectedItems[id] = selectAll;
                    }
                }
            }

            $scope.toggleOne = function(selectedItems) {
                //("ddd");
                for (var id in selectedItems) {
                    if (selectedItems.hasOwnProperty(id)) {
                        if (!selectedItems[id]) {
                            s.selectAll = false;
                            return;
                        }
                    }
                }
                s.selectAll = true;
            }
        });

        table = $('#list-menage').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": window.wsurl + '/enquete/getQuestionnaire',
                "type": "POST",
                "data": {token: localStorage.token, enquete: s.enquete_id},
            },
            "pagingType": "full_numbers",
            "columns": [
                {
                    "data": "id",
                    "render": function (data, type, row, meta,s) {
                        return '<center><input type="checkbox" ng-model="selected[' + data + ']" id="chk_' + data + '" onclick="localStorage.setItem('+data+', '+data+');"></center>';
                    }
                },
                {
                    "data": "id",
                    "render": function (data, type, row, meta) {
                        return '<a href="#/showMenage/' + data + '" class="lien">Ménage N:' + data + '</a>';
                    }
                },
                {"data": getEnq()},
                {"data": getPrenom()},
                {"data": "numeromenage"},
                {"data": getRegion()},
                {"data": getCercle()},
                {"data": getCommune()},
                {"data": getVill()},
                {"data": "date"},
                {
                    "data": "etat",
                    "render": function (data, type, row, meta) {
                        var status = AppFactory.findStatusByCode(data);
                        status = _.isEmpty(status) ? Status[0] : status[0];
                        return status.label;
                    }
                },
            ]

        });


        $scope.filter = function () {
            var filtre = {};
            var empty = true;
            if ($scope.nummenage != undefined) {
                empty =false;
                filtre.nummenage = $scope.nummenage;
            }
            if ($scope.region != undefined) {
                empty =false;
                filtre.region = $scope.region;
            }
            if ($scope.cercle != undefined) {
                empty =false;
                filtre.cercle = $scope.cercle;
            }
            if ($scope.commune != undefined) {
                empty =false;
                filtre.commune = $scope.commune;
            }
            if ($scope.village != undefined) {
                empty =false;
                filtre.village = $scope.village;
            }
            if (empty == false) {


                table.destroy();
                //table.destroy();
                //$("#datatable_place").append('<table id="example" class="display" style="width:100%"> <thead> <tr> <th> <center> <input type="checkbox" ng-model="selectAll" onclick="toggleAll(selectAll,selected)"> </center> </th> <th>Ménage</th> <th>Enquête</th> <th>Enquêteur</th> <th>Numéro du ménage</th> <th> Région</th> <th> Cercle </th> <th> Commune </th> <th> Village </th> <th> Date Questionnaire </th> <th> Etat </th> </tr> </thead> </table>');

                table = $('#list-menage').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": window.wsurl + '/setting/menage_filter',
                        "type": "POST",
                        "data": {token: localStorage.token, filtre: filtre},
                    },
                    "pagingType": "full_numbers",
                    "columns": [
                        {
                            "data": "id",
                            "render": function (data, type, row, meta) {
                                return '<center><input type="checkbox" ng-model="selected[' + data + ']" onclick="toggleOne(selected)"></center>';
                            }
                        },
                        {
                            "data": "id",
                            "render": function (data, type, row, meta) {
                                return '<a href="#/showQuestionnaire/' + data + '" class="lien">Ménage N:' + data + '</a>';
                            }
                        },
                        {"data": getEnq()},
                        {"data": getPrenom()},
                        {"data": "numeromenage"},
                        {"data": getRegion()},
                        {"data": getCercle()},
                        {"data": getCommune()},
                        {"data": getVill()},
                        {"data": "date"},
                        {
                            "data": "etat",
                            "render": function (data, type, row, meta) {
                                var status = AppFactory.findStatusByCode(data);
                                status = _.isEmpty(status) ? Status[0] : status[0];
                                return status.label;
                            }
                        },
                    ]

                });
            }
        };


        function toggleAll(selectAll, selectedItems) {
            alert("test");

            for (var id in selectedItems) {
                if (selectedItems.hasOwnProperty(id)) {
                    selectedItems[id] = selectAll;
                }
            }
        }

        function toggleOne(selectedItems) {
            //("ddd");
            for (var id in selectedItems) {
                if (selectedItems.hasOwnProperty(id)) {
                    if (!selectedItems[id]) {
                        $scope.selectAll = false;
                        return;
                    }
                }
            }
            $scope.selectAll = true;
        }

        $scope.confirmDelete = function () {

            $('#Modaldeletequest').modal('show');

        };

        $scope.questionnaireDelete = function () {
            $(".spinme").show();
            var arrayText = [];
            var Id = "";
            for (var key in $scope.selected) {
                if ($scope.selected[key]) {   ////(key);
                    arrayText.push({"id": key});

                }
            }

            scope.url = window.wsurl + '/enquete/deleteQuest';

            $http.post($scope.url, {"data": arrayText, "token": localStorage.token}).success(function () {
                $route.reload();
                $(".spinme").hide();
            });
            $

            $.toast({
                heading: 'Suppression Avec Succès',
                text: 'Questionnaire Suprrimé Avec Succès.',
                showHideTransition: 'slide',
                icon: 'success',
                position: 'top-right'
            });
            $('#Modaldeletequest').modal('hide');


        };


    }]);

app.controller('MenageShowCtrl', ['$scope', '$http', '$route', '$location', '$window', "DTOptionsBuilder", "DTColumnBuilder",
    "DTDefaultOptions", "DTColumnDefBuilder", "$compile", '$rootScope', '$routeParams', 'chefUpload', 'AppFactory',
    function ($scope, $http, $route, $location, $window, DTOptionsBuilder, DTColumnBuilder, DTDefaultOptions, DTColumnDefBuilder, $compile, $rootScope, $routeParams, chefUpload, AppFactory) {
        var id = $routeParams.menage_id;
        var menage;
        $(".spinme").show();
        $scope.questionaireshow = false;
        $scope.url = window.wsurl + '/enquete/search_questionnaire';
        $http.post($scope.url, {"id": id, "token": localStorage.token, "checkprofile": false}).success(function (response) {
            if (response != false) {

                menage = JSON.parse(response.menage);
                var list_individu = JSON.parse(response.individu);
                $scope.village = response.village;
                $scope.id = response.id;
                var image_url = response.image;
                var path = window.wsurl;

                $scope.file_url = image_url;

                if (typeof(response.image) != "undefined" && image_url !== null) {
                    $scope.showImg = true;
                    $scope.image = path.substr(0, path.indexOf("web") + 4) + image_url.substr(7, image_url.length);
                }


                $scope.individus = list_individu;

                $scope.individusplussix = [];

                list_individu.forEach(function (individu) {
                    age = calcAge(individu.demographique.date_naissance);
                    if (age > 6) {
                        if (typeof($scope.individusplussix) == "undefined") {
                            $scope.individusplussix = [];
                        }
                        $scope.individusplussix.push(individu);
                    }


                    if (individu.demographique.role == "1") {

                        $scope.chefmenage = true;
                    }
                    if (individu.demographique.role == "2") {
                        $scope.remplacant = true;
                    }
                    if (individu.demographique.repondant == true) {
                        $scope.rep = true;
                    }
                    if (individu.sante !== undefined) {
                        if (individu.sante.handicap !== undefined && individu.sante.handicap.length != 0) {
                            individu.sante.handicap_choice = 1;
                        } else {
                            individu.sante.handicap_choice = 2;
                        }
                        if (individu.sante.maladie !== undefined && individu.sante.maladie.length != 0) {
                            individu.sante.maladie_choice = 1;
                        } else {
                            individu.sante.maladie_choice = 2;
                        }

                        if (individu.sante.maladie_choice == "1" || individu.sante.maladie_choice == 1) {
                            $scope.maladie_show = true;
                        } else {
                            $scope.maladie_show = false;
                        }
                    }
                });


                //$scope.rep = false;
                nbr_individu = list_individu.length;
                $scope.nina_show = false;
                $scope.parent_show = false;
                $scope.matrimoniale = false;
                $scope.femme_sante = false;
                $scope.rougeole = false;
                $scope.emploi = false;
                $scope.activite_secondaire_show = false;
                $scope.maladie_show = false;
                $scope.handicap_show = false;

                $scope.menage = menage;
                if ($scope.menage.nummenage) {
                    $scope.menage.nummenage = parseInt($scope.menage.nummenage);
                }

                $scope.select2Options = {
                    allowClear: true
                };

                $scope.at = null;
                if(!_.isUndefined(menage.date) && !_.isNull(menage.date)) {
                    var _at = AppFactory.timestampToDate(menage.date.timestamp);
                    $scope.at = AppFactory.toStringDate(_at.getDate(), _at.getUTCMonth() + 1, _at.getFullYear(), '-');
                }

                $scope.url = window.wsurl + '/enquete/createquestionnaire';
                $http({
                    url: $scope.url,
                    data: {enquete: menage.enquete, token: localStorage.token, date: $scope.at},
                    method: 'POST'


                }).then(function successCallback(response) {
                    $scope.roles = response.data.roles;
                    $(".spinme").hide();
                    $scope.questionaireshow = true;

                    $scope.referentiels = response.data;
                    $scope.parentes = $scope.referentiels.Parente;
                    $scope.residences = $scope.referentiels.StatutResidence;
                    $scope.nationalites = $scope.referentiels.Nationalite;
                    $scope.identites = $scope.referentiels.DocumentIdentite;
                    $scope.matrimoniales = $scope.referentiels.SituationMatrimoniale;
                    $scope.ethnies = $scope.referentiels.Ethnie;
                    $scope.parent_vies = $scope.referentiels.ParentVie;

                    $scope.langues = $scope.referentiels.Langue;
                    $scope.niveauinstructions = $scope.referentiels.NiveauInstruction;
                    $scope.raisonnonfrequentationecoles = $scope.referentiels.RaisonNonFrequentationEcole;

                    $scope.maladies = $scope.referentiels.Maladie;
                    $scope.handicaps = $scope.referentiels.Handicap;

                    $scope.situationoccupations = $scope.referentiels.SituationOccupation;
                    $scope.activiteprincipales = $scope.referentiels.ActivitePrincipale;
                    $scope.situationactivites = $scope.referentiels.SituationActivite;
                    $scope.brancheactivites = $scope.referentiels.BrancheActivite;
                    $scope.autreactivites = $scope.referentiels.AutreActivite;

                    $scope.typehabitats = $scope.referentiels.TypeHabitat;
                    $scope.statutoccupationlogements = $scope.referentiels.StatutOccupationLogement;
                    $scope.materiautoits = $scope.referentiels.MateriauToit;
                    $scope.materiaumurs = $scope.referentiels.MateriauMur;
                    $scope.materiausols = $scope.referentiels.MateriauSol;
                    $scope.typeaisances = $scope.referentiels.TypeAisance;
                    $scope.eclairages = $scope.referentiels.Eclairage;
                    $scope.energiecuisines = $scope.referentiels.EnergieCuisine;
                    $scope.endroitcuisines = $scope.referentiels.EndroitCuisine;
                    $scope.sourceeaux = $scope.referentiels.SourceEau;
                    $scope.eausaines = $scope.referentiels.EauSaine;
                    $scope.evacuationordures = $scope.referentiels.EvacuationOrdure;

                    $scope.depensealimentaires = $scope.referentiels.DepenseAlimentaire;
                    $scope.consommationalimetaires = $scope.referentiels.ConsommationAlimentaire;

                    $scope.sourcerevenues = $scope.referentiels.SourceRevenue;

                    if ($scope.menage.animaux.exist == 1) {
                        $scope.show_animaux = true;
                    } else {
                        $scope.show_animaux = false;
                    }

                    var animauxArray = ["trait", "bovin", "caprin", "equin",
                        , "porcin", "volaille", "asin", "camelin", "ovin"];

                    $scope.menage.animaux.exist = 2;
                    $scope.show_animaux = false;
                    animauxArray.forEach(function (animal) {

                        if ($scope.menage.animaux[animal] !== 0 && $scope.menage.animaux[animal] !== undefined) {

                            $scope.menage.animaux.exist = 1;
                            $scope.show_animaux = true;
                        }
                    });
                    //
                    //($scope.village);
                    $scope.menage.region = $scope.village.commune.cercle.region;
                    $scope.menage.cercle = $scope.village.commune.cercle;
                    $scope.menage.commune = $scope.village.commune;
                    $scope.menage.village = $scope.village;

                    var depensealimentaireArray = ["cereale", "racine", "legumineuse", "legume", "fruit",
                        , "viande", "lait", "huile", "sucre", "the", "epice", "autre"];

                    var consoalimentaireArray = ["cereale", "racine", "legumineuse", "lait", "viandes", "viande", "foie", "poisson"
                        , "oeuf", "legume", "legumeorange", "legumeverte", "fruit", "fruitorange", "huile", "sucre", "epice"];

                    if (typeof($scope.menage.depensealimentaire) != "undefined") {
                        depensealimentaireArray.forEach(function (depense) {
                            if (!_.isUndefined($scope.menage.depensealimentaire[depense]) && $scope.menage.depensealimentaire[depense].consommation === "2") {
                                $scope["depense_" + depense + "_show"] = true;
                            }
                        });
                    }

                    if(!_.isUndefined($scope.menage.consoalimentaire)) {
                        consoalimentaireArray.forEach(function (produit) {
                            if ($scope.menage.consoalimentaire[produit] !== undefined) {
                                if (($scope.menage.consoalimentaire[produit].consohier === "2") && ($scope.menage.consoalimentaire[produit].nbrjour === 0)) {
                                    $scope[produit + "AlimentCons_show"] = true;
                                }
                                if ($scope.menage.consoalimentaire[produit].consohier == 1) {
                                    $scope["consommer_" + produit] = false;
                                    $scope['minNbrjour' + produit] = 1;
                                    $scope['maxNbrjour' + produit] = 7;
                                } else if ($scope.menage.consoalimentaire[produit].consohier == 2) {
                                    $scope['minNbrjour' + produit] = 0;
                                    $scope['maxNbrjour' + produit] = 6;
                                    if ($scope.menage.consoalimentaire[produit].nbrjour == 0) {
                                        $scope["consommer_" + produit] = true;
                                    } else {
                                        $scope["consommer_" + produit] = false;
                                    }
                                }
                            }
                        });
                    }

                    setTimeout(function () {

                        if ($scope.menage.comodites.typehabibat !== undefined && $scope.menage.comodites.typehabibat !== null) {
                            $("#typehabitat").select2('val', $scope.menage.comodites.typehabibat.id);
                        }
                        if ($scope.menage.comodites.statutoccupationlogement !== undefined && $scope.menage.comodites.statutoccupationlogement !== null) {
                            $("#statutoccupationlogement").select2('val', $scope.menage.comodites.statutoccupationlogement.id);
                        }
                        if ($scope.menage.comodites.materiautoit !== undefined && $scope.menage.comodites.materiautoit !== null) {
                            $("#materiautoit").select2('val', $scope.menage.comodites.materiautoit.id);
                        }
                        if ($scope.menage.comodites.materiaumur !== undefined && $scope.menage.comodites.materiaumur !== null) {
                            $("#materiaumur").select2('val', $scope.menage.comodites.materiaumur.id);
                        }

                        if ($scope.menage.comodites.materiausol !== undefined && $scope.menage.comodites.materiausol !== null) {
                            $("#materiausol").select2('val', $scope.menage.comodites.materiausol.id);
                        }
                        if ($scope.menage.comodites.typeaisance !== undefined && $scope.menage.comodites.typeaisance !== null) {
                            $("#typeaisance").select2('val', $scope.menage.comodites.typeaisance.id);
                        }
                        if ($scope.menage.comodites.eclairage !== undefined && $scope.menage.comodites.eclairage !== null) {
                            $("#eclairage").select2('val', $scope.menage.comodites.eclairage.id);
                        }
                        if ($scope.menage.comodites.endroitcuisine !== undefined && $scope.menage.comodites.endroitcuisine !== null) {
                            $("#endroitcuisine").select2('val', $scope.menage.comodites.endroitcuisine.id);
                        }
                        if ($scope.menage.comodites.energiecuisine !== undefined && $scope.menage.comodites.energiecuisine !== null) {
                            $("#energiecuisine").select2('val', $scope.menage.comodites.energiecuisine.id);
                        }
                        if ($scope.menage.comodites.sourceeau !== undefined && $scope.menage.comodites.sourceeau !== null) {
                            $("#sourceeau").select2('val', $scope.menage.comodites.sourceeau.id);
                        }

                        if ($scope.menage.comodites.eausaine !== undefined && $scope.menage.comodites.eausaine !== null) {
                            $("#eausaine").select2('val', $scope.menage.comodites.eausaine.id);
                        }
                        if ($scope.menage.comodites.evacuationordure !== undefined && $scope.menage.comodites.evacuationordure !== null) {
                            $("#evacuationordure").select2('val', $scope.menage.comodites.evacuationordure.id);
                        }


                        if (typeof($scope.menage.depensealimentaire) != "undefined") {
                            depensealimentaireArray.forEach(function (depense) {
                                if (!_.isUndefined($scope.menage.depensealimentaire[depense]) && !_.isNull($scope.menage.depensealimentaire[depense].source) && $scope.menage.depensealimentaire[depense].source !== undefined) {
                                    $("#depense_" + depense).select2('val', $scope.menage.depensealimentaire[depense].source.id);
                                }
                            });
                        }

                        if(!_.isUndefined($scope.menage.consoalimentaire)) {
                            consoalimentaireArray.forEach(function (produit) {
                                if ($scope.menage.consoalimentaire[produit] !== undefined && !_.isNull($scope.menage.consoalimentaire[produit].source) && $scope.menage.consoalimentaire[produit].source !== undefined) {
                                    $("#conso_" + produit).select2('val', $scope.menage.consoalimentaire[produit].source.id);
                                }
                            });
                        }


                        nbr_source_revenue = 0;
                        angular.forEach($scope.menage.sourcerevenue, function (source, key) {
                            nbr_source_revenue++;
                            add = '<tr><td>' + nbr_source_revenue + '</td><td><label>' + source.source.label + '</label>'
                                + '</td><td><label>' + AppFactory.thousandFormatter(source.apport) + '</label></td></tr>';
                            $("#source_revenue").append($compile(add)($scope));
                        });


                    }, 1000);

                    $scope.parente_show = true;


                });

                $scope.confirm = function () {

                    $('#myModal').modal('show');

                };

                $scope.change = function (val) {

                    if (val == 1 || val == 2 || val == 3) {
                        $scope.datearrive_show = false;
                    } else {
                        $scope.datearrive_show = true;
                    }

                };

                $scope.situationoccupation_change = function (val) {

                    if (val == 1 || val == 2) {
                        $scope.emploi = true;
                    } else {
                        $scope.emploi = false;
                    }

                    if (val == 1) {
                        $scope.activite_secondaire_show = true;
                    } else {
                        $scope.activite_secondaire_show = false;
                    }


                };

                $scope.nina_change = function (val) {

                    $scope.nina_show = false;
                    found = 0;
                    angular.forEach(val, function (iden, key) {
                        if (iden.id == 3) {
                            found = 1;
                        }
                    });
                    if (found == 1) {
                        $scope.nina_show = true;
                        //$scope.individu.demographique.nina = "";
                    }
                };

                $scope.age_controll = function () {

                    age = calcAge($scope.individu.demographique.date_naissance);

                    if (age >= 12) {
                        $scope.matrimoniale_show = true;
                    } else {
                        $scope.matrimoniale_show = false;
                    }

                    if (age <= 17) {
                        $scope.parent_show = true;
                    } else {
                        $scope.parent_show = false;
                    }


                    if (($scope.individu.demographique.role == "1" || $scope.individu.demographique.role == "2") && age < 18) {
                        $scope.majeur_show = true;
                        $scope.conjoint_age_show = false;
                    } else {
                        $scope.majeur_show = false;
                    }

                    if (typeof $scope.individu.demographique.role === "undefined") {
                        if ((typeof $scope.individu.demographique.parente !== "undefined")) {
                            if ($scope.individu.demographique.parente.code == "2" && age < 12) {
                                $scope.conjoint_age_show = true;
                                $scope.majeur_show = false;
                            } else {
                                $scope.conjoint_age_show = false;
                            }
                        }
                    }
                };

                $scope.validerIdentification = function (form) {
                    state = true;
                    if (typeof ($scope.villagechoice) === "undefined") {
                        state = false;
                    }

                    if (!form.validate() || !state) {
                        $.toast({
                            heading: 'Section Invalide',
                            text: 'Veuillez corriger la section.',
                            showHideTransition: 'slide',
                            icon: 'warning',
                            position: 'top-right'
                        });
                    } else {
                        $.toast({
                            heading: 'Section valide',
                            text: 'La section est valide.',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                    }
                }

                $scope.validerCommodites = function (form) {
                    state = true;

                    if (typeof ($scope.menage.comodites) === "undefined") {
                        state = false;
                        $("#error_typehabibat").toggle();
                        $("#error_statutoccupationlogement").show();
                        $("#error_materiautoit").show();
                        $("#error_materiaumur").show();

                    } else {
                        if (typeof ($scope.menage.comodites.typehabibat) === "undefined") {
                            state = false;
                            $("#error_typehabibat").show();
                        }
                        if (typeof ($scope.menage.comodites.statutoccupationlogement) === "undefined") {
                            state = false;
                            $("#error_statutoccupationlogement").show();
                        }
                        if (typeof ($scope.menage.comodites.materiautoit) === "undefined") {
                            state = false;
                            $("#error_materiautoit").show();
                        }
                        if (typeof ($scope.menage.comodites.materiaumur) === "undefined") {
                            state = false;
                            $("#error_materiaumur").show();
                        }


                    }
                    if (!form.validate() || !state) {
                        $.toast({
                            heading: 'Section Invalide',
                            text: 'Veuillez corriger la section.',
                            showHideTransition: 'slide',
                            icon: 'warning',
                            position: 'top-right'
                        });
                    } else {
                        $.toast({
                            heading: 'Section valide',
                            text: 'La section est valide.',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                    }
                }

                $scope.validerEquipements = function (form) {
                    state = true;
                    if (typeof ($scope.menage.equipements) === "undefined") {
                        $("#error_internet").show();
                    }
                    else {
                        if (typeof ($scope.menage.equipements.internet) === "undefined") {
                            state = false;
                            $("#error_internet").show();
                        }
                    }
                    if (!form.validate() || !state) {
                        $.toast({
                            heading: 'Section Invalide',
                            text: 'Veuillez corriger la section.',
                            showHideTransition: 'slide',
                            icon: 'warning',
                            position: 'top-right'
                        });
                    } else {
                        $.toast({
                            heading: 'Section valide',
                            text: 'La section est valide.',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                    }
                }

                $scope.validerAnimaux = function (form) {
                    state = true;

                    if (typeof ($scope.menage.animaux) === "undefined") {
                        state = false;
                    }

                    if (!form.validate() || !state) {
                        $.toast({
                            heading: 'Section Invalide',
                            text: 'Veuillez corriger la section.',
                            showHideTransition: 'slide',
                            icon: 'warning',
                            position: 'top-right'
                        });
                    } else {
                        $.toast({
                            heading: 'Section valide',
                            text: 'La section est valide.',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                    }
                }

                $scope.validerDepense = function (form) {

                    if (!form.validate()) {
                        $.toast({
                            heading: 'Section Invalide',
                            text: 'Veuillez corriger la section.',
                            showHideTransition: 'slide',
                            icon: 'warning',
                            position: 'top-right'
                        });
                    } else {
                        $.toast({
                            heading: 'Section valide',
                            text: 'La section est valide.',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                    }
                }


                $scope.validerAlimentaire = function (form) {
                    state = true;
                    //Consommation Alimentaire controles
                    var consoalimentaireArray = ["cereale", "racine", "legumineuse", "lait", "viandes", "viande", "foie", "poisson"
                        , "oeuf", "legume", "legumeorange", "legumeverte", "fruit", "fruitorange", "huile", "sucre", "epice"];

                    if (typeof ($scope.menage.consoalimentaire) === "undefined") {
                        consoalimentaireArray.forEach(function (produit) {
                            state = false;
                            $("#error_consoalimentaire" + produit + "consohier").show();
                            $("#error_consoalimentaire" + produit).show();
                        });
                    } else if (typeof ($scope.menage.consoalimentaire) !== "undefined") {
                        consoalimentaireArray.forEach(function (produit) {
                            if (typeof ($scope.menage.consoalimentaire[produit]) !== "undefined") {
                                if ((typeof ($scope.menage.consoalimentaire[produit].source) === "undefined") && ($scope.menage.consoalimentaire[produit].nbrjour != 0)) {
                                    state = false;
                                    $("#error_consoalimentaire" + produit).show();
                                }
                                if (typeof ($scope.menage.consoalimentaire[produit].consohier) === "undefined") {
                                    state = false;
                                    $("#error_consoalimentaire" + produit + "consohier").show();
                                }
                            }
                        });
                    }

                    //Dépenses Alimentaires controles
                    var depensealimentaireArray = ["cereale", "racine", "legumineuse", "legume", "fruit",
                        , "viande", "lait", "huile", "sucre", "the", "epice", "autre"];

                    if (typeof ($scope.menage.depensealimentaire) === "undefined") {
                        depensealimentaireArray.forEach(function (depense) {
                            state = false;
                            $("#error_depensealimentaire" + depense + "consommation").show();
                            $("#error_depensealimentaire" + depense).show();
                        });
                    } else if (typeof ($scope.menage.depensealimentaire) !== "undefined") {
                        depensealimentaireArray.forEach(function (depense) {
                            if (typeof ($scope.menage.depensealimentaire[depense]) !== "undefined") {
                                if ((typeof ($scope.menage.depensealimentaire[depense].source) === "undefined") && ($scope.menage.depensealimentaire[depense].source == 1)) {
                                    state = false;
                                    $("#error_depensealimentaire" + depense).show();
                                }
                                if ((typeof ($scope.menage.depensealimentaire[depense].consommation) === "undefined") && ($scope.menage.depensealimentaire[depense].source == 1)) {
                                    state = false;
                                    $("#error_depensealimentaire" + depense + "consommation").show();
                                }
                            }
                        });
                    }
                    if (!form.validate() || !state) {
                        $.toast({
                            heading: 'Section Invalide',
                            text: 'Veuillez corriger la section.',
                            showHideTransition: 'slide',
                            icon: 'warning',
                            position: 'top-right'
                        });
                    } else {
                        $.toast({
                            heading: 'Section valide',
                            text: 'La section est valide.',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                    }
                }

                $scope.validerSourceRevenue = function (form) {
                    state = true;
                    if (typeof ($scope.menage.animaux) === "undefined") {
                        state = false;
                        $("#error_exist").show();
                    }

                    if (typeof ($scope.menage.sourcerevenue) === "undefined") {
                        state = false;
                        $("#error_sourcerevenue1").show();
                    } else {

                        if (typeof ($scope.menage.sourcerevenue[1]) === "undefined") {
                            state = false;
                            $("#error_sourcerevenue1").show();
                        } else if (typeof ($scope.menage.sourcerevenue[1].apport) === "undefined") {
                            state = false;
                        }
                    }
                    if (!form.validate() || !state) {
                        $.toast({
                            heading: 'Section Invalide',
                            text: 'Veuillez corriger la section.',
                            showHideTransition: 'slide',
                            icon: 'warning',
                            position: 'top-right'
                        });
                    } else {
                        $.toast({
                            heading: 'Section valide',
                            text: 'La section est valide.',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                    }
                }

                $scope.save_questionnaire = function (form) {

                    var state = true;
                    var active = "#" + $(".bhoechie-tab-content.active").attr('id');
                    $(".bhoechie-tab-content").addClass("active");
                    $("#tab_alim_2").show();

                    if (typeof ($scope.menage.numero) === "undefined") {
                        state = false;
                        $("#error_numeromenage").show();
                    }

                    if (typeof ($scope.menage.equipements) === "undefined") {
                        $("#error_internet").show();
                    }
                    else {
                        if (typeof ($scope.menage.equipements.internet) === "undefined") {
                            state = false;
                            $("#error_internet").show();
                        }
                    }

                    if (typeof ($scope.menage.comodites) === "undefined") {
                        state = false;
                        $("#error_typehabibat").toggle();
                        $("#error_statutoccupationlogement").show();
                        $("#error_materiautoit").show();
                        $("#error_materiaumur").show();

                    } else {
                        if (typeof ($scope.menage.comodites.typehabibat) === "undefined") {
                            state = false;
                            $("#error_typehabibat").show();
                        }
                        if (typeof ($scope.menage.comodites.statutoccupationlogement) === "undefined") {
                            state = false;
                            $("#error_statutoccupationlogement").show();
                        }
                        if (typeof ($scope.menage.comodites.materiautoit) === "undefined") {
                            state = false;
                            $("#error_materiautoit").show();
                        }
                        if (typeof ($scope.menage.comodites.materiaumur) === "undefined") {
                            state = false;
                            $("#error_materiaumur").show();
                        }


                    }

                    if (typeof ($scope.menage.sourcerevenue) === "undefined") {
                        state = false;
                        /* $("#error_sourcerevenue4").show();
                         $("#error_sourcerevenue3").show();
                         $("#error_sourcerevenue2").show();*/
                        $("#error_sourcerevenue1").show();
                    } else {

                        /* if (typeof ($scope.menage.sourcerevenue[4]) === "undefined") {
                         state = false;
                         $("#error_sourcerevenue4").show();
                         } else if (typeof ($scope.menage.sourcerevenue[4].apport) === "undefined") {
                         state = false;
                         $("#error_sourcerevenue4").show();
                         }


                         if (typeof ($scope.menage.sourcerevenue[3]) === "undefined") {
                         state = false;
                         $("#error_sourcerevenue3").show();
                         } else if (typeof ($scope.menage.sourcerevenue[3].apport) === "undefined") {
                         state = false;
                         $("#error_sourcerevenue3").show();
                         }

                         if (typeof ($scope.menage.sourcerevenue[2]) === "undefined") {
                         state = false;
                         $("#error_sourcerevenue2").show();
                         } else if (typeof ($scope.menage.sourcerevenue[2].apport) === "undefined") {
                         state = false;
                         $("#error_sourcerevenue2").show();
                         }*/

                        if (typeof ($scope.menage.sourcerevenue[1]) === "undefined") {
                            state = false;
                            $("#error_sourcerevenue1").show();
                        } else if (typeof ($scope.menage.sourcerevenue[1].apport) === "undefined") {
                            state = false;
                            $("#error_sourcerevenue1").show();
                        }
                    }//Consommation Alimentaire controles
                    var consoalimentaireArray = ["cereale", "racine", "legumineuse", "lait", "viandes", "viande", "foie", "poisson"
                        , "oeuf", "legume", "legumeorange", "legumeverte", "fruit", "fruitorange", "huile", "sucre", "epice"];

                    if (typeof ($scope.menage.consoalimentaire) === "undefined") {
                        consoalimentaireArray.forEach(function (produit) {
                            state = false;
                            $("#error_consoalimentaire" + produit + "consohier").show();
                            $("#error_consoalimentaire" + produit).show();
                        });
                    } else if (typeof ($scope.menage.consoalimentaire) !== "undefined") {
                        consoalimentaireArray.forEach(function (produit) {
                            if (typeof ($scope.menage.consoalimentaire[produit]) !== "undefined") {
                                if ((typeof ($scope.menage.consoalimentaire[produit].source) === "undefined") && ($scope.menage.consoalimentaire[produit].nbrjour != 0)) {
                                    state = false;
                                    $("#error_consoalimentaire" + produit).show();
                                }
                                if (typeof ($scope.menage.consoalimentaire[produit].consohier) === "undefined") {
                                    state = false;
                                    $("#error_consoalimentaire" + produit + "consohier").show();
                                }
                            }
                        });
                    }

                    //Dépenses Alimentaires controles
                    var depensealimentaireArray = ["cereale", "racine", "legumineuse", "legume", "fruit",
                        , "viande", "lait", "huile", "sucre", "the", "epice", "autre"];

                    if (typeof ($scope.menage.depensealimentaire) === "undefined") {
                        depensealimentaireArray.forEach(function (depense) {
                            state = false;
                            $("#error_depensealimentaire" + depense + "consommation").show();
                            $("#error_depensealimentaire" + depense).show();
                        });
                    } else if (typeof ($scope.menage.depensealimentaire) !== "undefined") {
                        depensealimentaireArray.forEach(function (depense) {
                            if (typeof ($scope.menage.depensealimentaire[depense]) !== "undefined") {
                                if ((typeof ($scope.menage.depensealimentaire[depense].source) === "undefined") && ($scope.menage.depensealimentaire[depense].source == 1)) {
                                    state = false;
                                    $("#error_depensealimentaire" + depense).show();
                                }
                                if ((typeof ($scope.menage.depensealimentaire[depense].consommation) === "undefined") && ($scope.menage.depensealimentaire[depense].source == 1)) {
                                    state = false;
                                    $("#error_depensealimentaire" + depense + "consommation").show();
                                }
                            }
                        });
                    }

                    var _isIncoherent = false;
                    $scope.individus.forEach(function (individu) {
                        if (typeof (individu.education) == "undefined") {
                            state = false;
                        }
                        if (typeof (individu.sante) == "undefined") {
                            state = false;
                        }
                        var age = calcAge(individu.demographique.date_naissance);
                        if (age > 6 && typeof (individu.emploi) == "undefined") {
                            state = false;
                        }

                        if (typeof (individu.demographique.identite) === "undefined"){
                            state = false;
                        }else{
                            if (_.isArray(individu.demographique.identite) && (typeof (individu.demographique.identite.find(x => x.id === '1')) !== "undefined") && (individu.demographique.identite.length > 1)) {
                                state = false;
                                _isIncoherent = true;
                                $.toast({
                                    heading: 'Incoherence',
                                    text: 'Incoherence au niveau des document d\'identité.',
                                    showHideTransition: 'slide',
                                    icon: 'error',
                                    position: 'top-right'
                                });
                            }
                        }

                        if (typeof (individu.education.langue) === "undefined"){
                            state = false;
                        }else{
                            if (_.isArray(individu.education.langue) && ((typeof (individu.education.langue.find(x => x.id === '1')) !== "undefined")||(typeof (individu.education.langue.find(x => x.id === '14')) !== "undefined")) && (individu.education.langue.length > 1)) {
                                state = false;
                                _isIncoherent = true;
                                $.toast({
                                    heading: 'Incoherence',
                                    text: 'Incoherence au niveau de la langue.',
                                    showHideTransition: 'slide',
                                    icon: 'error',
                                    position: 'top-right'
                                });
                            }
                        }
                    });


                    $scope.sendurl = window.wsurl + '/enquete/new_questionnaire_web';
                    //$scope.menage.nummenage = $scope.numeroTel;

                    if (form.validate() && state === true && list_individu.length !== 0) {
                        var file = $scope.myFile;
                        chefUpload.uploadFileToUrlUpdate(id, file, $scope.file_url, $scope.sendurl, list_individu, $scope.menage, $scope.enquete_id, localStorage.token);
                        /*$http.post($scope.sendurl, { "listindividu": list_individu, "menage": $scope.menage, "enquete": $scope.enquete_id, "token": localStorage.token }).
                         success(function (response) {
                         //$location.url('\enquete');
                         });*/
                    } else {
                        $(".bhoechie-tab-content").removeClass("active");
                        $(active).addClass("active");
                        $("#tab_alim_2").hide();
                        if(_isIncoherent == false) {
                            if (list_individu.length === 0) {
                                $.toast({
                                    heading: 'Champs obligatoires',
                                    text: 'Veuillez remplir les champs obligatoires et ajouter un individu.',
                                    showHideTransition: 'slide',
                                    icon: 'warning',
                                    position: 'top-right'
                                });
                            } else {
                                $.toast({
                                    heading: 'Champs obligatoires',
                                    text: 'Veuillez remplir les champs obligatoires.',
                                    showHideTransition: 'slide',
                                    icon: 'warning',
                                    position: 'top-right'
                                });
                            }
                        }
                    }
                };

                nbr_source_revenue = 4;


                $scope.add_source_revenue = function () {
                    nbr_source_revenue++;
                    add = '<tr><td>' + nbr_source_revenue + '</td><td><select class=" js-example-basic-multiple form-control demographique "'
                        + 'ng-options="sourcerevenue.label for sourcerevenue in sourcerevenues track by sourcerevenue.id" ng-model="menage.sourcerevenue[' + nbr_source_revenue + '].source"> </select>'
                        + '</td><td><input type="number" min="0" class="form-control" ng-model="menage.sourcerevenue[' + nbr_source_revenue + '].apport"></td></tr>'
                    $("#source_revenue").append($compile(add)($scope));

                };


                $scope.count = 0;


                $scope.alleecole_function = function () {
                    //($scope.individu.education.alleecole);
                    if ($scope.individu.education.alleecole == 1) {
                        $scope.frequenteecole_show = true;
                    } else {
                        $scope.frequenteecole_show = false;
                        $scope.classe_show = false;
                    }
                }

                $scope.frequenteecole_function = function () {
                    //($scope.individu.education.frequenteecole);
                    if ($scope.individu.education.frequenteecole == 1) {
                        $scope.classe_show = true;
                        $scope.raisonnonfrequentationecole = false;
                    } else {
                        $scope.classe_show = false;
                        $scope.raisonnonfrequentationecole = true;

                    }
                }

                $scope.demographique = function () {
                    $scope.datearrive_show = false;
                    $scope.langue_show = false;
                    $scope.frequenteecole_show = false;
                    $scope.classe_show = false;
                    $scope.raisonnonfrequentationecole = false;
                    $scope.niveauinstruction = false;
                    $scope.add_show = false;
                    $scope.individu_not_selected = true;
                    $scope.maladie_show = false;
                    $scope.handicap_show = false;
                    $scope.emploi = false;
                    $scope.parent_show = false;
                    $scope.parente_show = false;
                    $scope.chef_menage_selected = false;
                    $scope.activite_secondaire_show = false;


                    $("#maladie").select2('val', null);
                    $("#handicap").select2('val', null);
                    $("#situationoccupation").select2('val', null);
                    $("#langue").select2('val', null);
                    $("#niveauinstruction").select2('val', null);
                    if ($scope.indiv !== null) {

                        $scope.add_show = true;
                        $scope.alleecole_show = true;

                        if (typeof $scope.indiv.education !== "undefined") {
                            if (typeof $scope.indiv.education.classe !== "undefined") {
                                $scope.classe_show = true;
                            }

                            if (typeof $scope.indiv.education.frequenteecole !== "undefined") {
                                $scope.frequenteecole_show = true;
                            }
                        }


                        var age = calcAge($scope.indiv.demographique.date_naissance);
                        //("date naissance: " + $scope.indiv.demographique.date_naissance);
                        //("Age_demographique: " + age);
                        if (age > 3) {
                            $scope.langue_show = true;
                        } else {
                            $scope.langue_show = false;
                        }

                        if (age >= 15 && age <= 49 && $scope.indiv.demographique.sexe == 2) {
                            $scope.femme_sante = true;
                        } else {
                            $scope.femme_sante = false;
                        }
                        month = age * 12;
                        if (month >= 12 && month <= 23) {
                            $scope.rougeole = true;
                        } else {
                            $scope.rougeole = false;
                        }

                        var identite = [];
                        var langue = [];
                        var maladie = [];
                        var handicap = [];

                        var index = functiontofindIndexByKeyValue(list_individu, "id", $scope.indiv.id);
                        $scope.individu = $scope.individus[index];

                        if (typeof $scope.indiv.demographique !== "undefined") {

                            if ($scope.indiv.demographique.role == 1) {
                                $scope.chef_menage_selected = true;
                                $scope.parente_show = false;
                            } else {
                                $scope.chef_menage_selected = false;
                                $scope.parente_show = true;
                            }


                            if (typeof $scope.indiv.demographique.parente !== "undefined" && $scope.indiv.demographique.parente !== null) {
                                $("#parente").select2('val', $scope.indiv.demographique.parente.id);
                            }


                            if (typeof $scope.indiv.demographique.residence !== "undefined" && $scope.indiv.demographique.residence !== null) {
                                $("#residence").select2('val', $scope.indiv.demographique.residence.id);
                                var codes = ['4', '5', '6', '7'];
                                if (codes.indexOf($scope.indiv.demographique.residence.code) != -1) {
                                    if (typeof $scope.indiv.demographique.date_arrive !== "undefined") {
                                        $scope.datearrive_show = true;
                                    }
                                }
                            }

                            if (typeof $scope.indiv.demographique.nationalite !== "undefined" && $scope.indiv.demographique.nationalite !== null) {
                                $("#nationalite").select2('val', $scope.indiv.demographique.nationalite.id);
                            }


                            if (typeof $scope.indiv.demographique.identite !== "undefined" && $scope.indiv.demographique.identite !== null) {
                                angular.forEach($scope.indiv.demographique.identite, function (ident, key) {
                                    identite.push(ident.label);
                                });
                                $scope.identiteLabel = _.join(identite, ',');
                            }

                            if (typeof $scope.indiv.demographique.nina !== "undefined" && $scope.indiv.demographique.nina !== null) {
                                var testIdentite = false;
                                angular.forEach($scope.indiv.demographique.identite, function (ident, key) {
                                    if (ident.id == 3) {
                                        testIdentite = true;
                                    }
                                });
                                if (testIdentite == true) {
                                    $scope.nina_show = true;
                                }
                            } else {
                                $scope.nina_show = false;
                            }

                            if (typeof $scope.indiv.demographique.matrimoniale !== "undefined" && $scope.indiv.demographique.matrimoniale !== null) {
                                $("#matrimoniale").select2('val', $scope.indiv.demographique.matrimoniale.id);
                                $scope.matrimoniale_show = true;
                            }

                            if (typeof $scope.indiv.demographique.parent_vie !== "undefined" && $scope.indiv.demographique.parent_vie !== null) {
                                $("#parent_vie").select2('val', $scope.indiv.demographique.parent_vie.id);
                            }
                            if (typeof $scope.indiv.demographique.ethnie !== "undefined" && $scope.indiv.demographique.ethnie !== null) {
                                $("#ethnie").select2('val', $scope.indiv.demographique.ethnie.id);
                            }
                        }


                        if (typeof $scope.indiv.education !== "undefined") {
                            if (typeof $scope.indiv.education.langue !== "undefined" && $scope.indiv.education.langue !== null) {
                                angular.forEach($scope.indiv.education.langue, function (lang, key) {
                                    langue.push(lang.label);
                                });
                                $scope.langueLabel = _.join(langue, ',');
                            }

                            if (typeof $scope.indiv.education.classe !== "undefined" && $scope.indiv.education.classe !== null) {
                                $("#classe").select2('val', $scope.indiv.education.classe.id);
                                $("#niveauinstruction").select2('val', $scope.indiv.education.classe.id);
                            }

                            if (typeof $scope.indiv.education.niveauinstruction !== "undefined" && $scope.indiv.education.niveauinstruction !== null) {
                                $("#classe").select2('val', $scope.indiv.education.niveauinstruction.id);
                                $("#niveauinstruction").select2('val', $scope.indiv.education.niveauinstruction.id);
                            }

                            if (typeof $scope.indiv.education.raisonnonfrequentationecole !== "undefined" && $scope.indiv.education.frequenteecole != 1 && $scope.indiv.education.raisonnonfrequentationecole !== null) {
                                $scope.raisonnonfrequentationecole = true;
                                $("#raisonnonfrequentationecole").select2('val', $scope.indiv.education.raisonnonfrequentationecole.id);
                            }


                            if (typeof $scope.indiv.education.frequenteecole !== "undefined" && $scope.indiv.education.frequenteecole !== null) {
                                $scope.frequenteecole_show = true;
                            }

                            if (typeof $scope.indiv.education.classe !== "undefined" && $scope.indiv.education.classe !== null) {
                                $scope.classe_show = true;
                                $("#classe").select2('val', $scope.indiv.education.classe.id);
                            }

                        }


                        if (typeof $scope.indiv.sante !== "undefined") {

                            if (typeof $scope.indiv.sante.maladie !== "undefined" && $scope.indiv.sante.handicap.length != 0 && $scope.indiv.sante.maladie !== null) {
                                $scope.maladie_show = true;
                                angular.forEach($scope.indiv.sante.maladie, function (mal, key) {
                                    maladie.push(mal.label);
                                });
                                $scope.santeMaladie = _.join(maladie, ',');
                            }

                            if (typeof $scope.indiv.sante.handicap !== "undefined" && $scope.indiv.sante.handicap.length != 0 && $scope.indiv.sante.handicap != null) {
                                $scope.handicap_show = true;
                                angular.forEach($scope.indiv.sante.handicap, function (hand, key) {
                                    handicap.push(hand.label);
                                });
                                $scope.santeHandicap = _.join(handicap, ',');
                            }
                        }

                        if (typeof $scope.indiv.emploi !== "undefined") {

                            if (typeof $scope.indiv.emploi.situationoccupation !== "undefined" && $scope.indiv.emploi.situationoccupation !== null) {
                                $("#situationoccupation").select2('val', $scope.indiv.emploi.situationoccupation.id);
                                if ($scope.indiv.emploi.situationoccupation.id == 1 || $scope.indiv.emploi.situationoccupation.id == 2) {

                                    if (typeof $scope.indiv.emploi.activiteprincipale !== "undefined" && !_.isNull($scope.indiv.emploi.activiteprincipale)) {

                                        $("#activiteprincipale").select2('val', $scope.indiv.emploi.activiteprincipale.id);
                                    } else {
                                        $("#activiteprincipale").select2('val', '');
                                    }

                                    if (typeof $scope.indiv.emploi.situationactivite !== "undefined" && !_.isNull($scope.indiv.emploi.situationactivite)) {

                                        $("#situationactivite").select2('val', $scope.indiv.emploi.situationactivite.id);
                                    } else {
                                        $("#situationactivite").select2('val', '');
                                    }
                                    $scope.emploi = true;
                                }

                                if ($scope.indiv.emploi.situationoccupation.id == 1) {
                                    if (typeof $scope.indiv.emploi.brancheactivite !== "undefined" && !_.isNull($scope.indiv.emploi.brancheactivite)) {

                                        $("#brancheactivite").select2('val', $scope.indiv.emploi.brancheactivite.id);
                                    } else {
                                        $("#brancheactivite").select2('val', '');
                                    }

                                    if (typeof $scope.indiv.emploi.autreactivite !== "undefined" && !_.isNull($scope.indiv.emploi.autreactivite)) {

                                        $("#autreactivite").select2('val', $scope.indiv.emploi.autreactivite.id);
                                    } else {
                                        $("#autreactivite").select2('val', '');
                                    }
                                    $scope.activite_secondaire_show = true;
                                } else {
                                    $("#activiteprincipale").select2('val', '');
                                    $("#situationactivite").select2('val', '');
                                    $scope.emploi = false;
                                    $("#brancheactivite").select2('val', '');
                                    $("#autreactivite").select2('val', '');
                                    $scope.activite_secondaire_show = false;
                                }

                            } else {
                                $("#activiteprincipale").select2('val', '');
                                $("#situationactivite").select2('val', '');
                                $scope.emploi = false;
                                $("#brancheactivite").select2('val', '');
                                $("#autreactivite").select2('val', '');
                                $scope.activite_secondaire_show = false;
                            }
                        } else {
                            $("#activiteprincipale").select2('val', '');
                            $("#situationactivite").select2('val', '');
                            $scope.emploi = false;
                            $("#brancheactivite").select2('val', '');
                            $("#autreactivite").select2('val', '');
                            $scope.activite_secondaire_show = false;
                        }


                    } else {
                        $scope.individu = {};
                        $scope.individu_form.$setPristine(true);
                        $(".demographique").select2('val', '');
                    }
                    $(".individu_select").select2('val', $scope.indiv.id);
                };

                $scope.add_individu = function (individu, section) {
                    $scope.individu_not_selected = false;
                    var state = true;

                    if (typeof individu !== "undefined") {
                        if (typeof individu.demographique.date_naissance !== "undefined") {
                            var age = calcAge(individu.demographique.date_naissance);
                        }
                    }

                    if (section === 1 && typeof individu === "undefined") {
                        state = false;
                        $("#error_nom").show();
                        $("#error_prenom").show();
                        $("#error_parente").show();
                        $("#error_sexe").show();
                        $("#error_residence").show();
                        $("#error_datenaissance").show();
                        $("#error_identite").show();
                        //$("#error_lieunaissance").show();
                        //$("#error_nationalite").show();
                        //$("#error_ethnie").show();
                    }
                    else if (section === 1 && typeof individu !== "undefined") {
                        if (typeof (individu.demographique.nom) === "undefined") {
                            state = false;
                            $("#error_nom").show();
                        }
                        if (typeof (individu.demographique.prenom) === "undefined") {
                            state = false;
                            $("#error_prenom").show();
                        }
                        if (typeof (individu.demographique.parente) === "undefined" && individu.demographique.role != 1) {
                            state = false;
                            $("#error_parente").show();
                        }
                        if (typeof (individu.demographique.sexe) === "undefined") {
                            state = false;
                            $("#error_sexe").show();
                        }
                        if (typeof (individu.demographique.residence) === "undefined") {
                            state = false;
                            $("#error_residence").show();
                        }
                        if (typeof (individu.demographique.date_naissance) === "undefined") {
                            state = false;
                            $("#error_datenaissance").show();
                        }
                        if (typeof (individu.demographique.date_arrive) === "undefined" && $scope.datearrive_show === true) {
                            state = false;
                            $("#error_datearrive").show();
                        }
                        if (typeof (individu.demographique.identite) === "undefined") {
                            state = false;
                            $("#error_identite").show();
                        }

                        if (_.isArray(individu.demographique.identite) && (typeof (individu.demographique.identite.find(x => x.id === '1')) !== "undefined") && (individu.demographique.identite.length > 1)) {
                            state = false;
                            $.toast({
                                heading: 'Incoherence',
                                text: 'Incoherence au niveau des documents d\'identité.',
                                showHideTransition: 'slide',
                                icon: 'error',
                                position: 'top-right'
                            });
                        }

                        if (typeof (individu.demographique.matrimoniale) === "undefined" && $scope.matrimoniale_show === true) {
                            state = false;
                            $("#error_matrimoniale").show();
                        }
                        var nina_regex = new RegExp('(1|2)[0-9]{13}[a-zA-Z]{1}|(1|2)[0-9]{2}[a-zA-Z]{2}[0-9]{9}[a-zA-Z]{1}');
                        nina_regex_match = nina_regex.test($('#nina').val());
                        if (individu.demographique.nina === "" && $scope.nina_show === true) {

                            state = false;


                            $("#error_nina").show();
                            $("#error_nina_regex").hide();
                        } else if (!nina_regex_match && $scope.nina_show === true) {

                            state = false;

                            $("#error_nina").hide();
                            $("#error_nina_regex").show();
                        }

                        if ((individu.demographique.role == 1 || individu.demographique.role == 2) && age < 18) {
                            $scope.majeur_show = true;
                            state = false;

                        }

                        if (individu.demographique.parente == 2 && age < 12) {
                            $scope.conjoint_age_show = true;
                            state = false;
                        }


                    }


                    if (section === 2 && typeof individu.education === "undefined") {
                        state = false;
                        $("#error_alleecole").show();
                        $("#error_niveauinstruction").show();
                        $scope.individu_not_selected = true;

                    }
                    else if (section === 2 && typeof individu.education !== "undefined") {
                        $scope.individu_not_selected = true;

                        if (_.isArray($scope.individu.education.langue) && ((typeof ($scope.individu.education.langue.find(x => x.id === '1')) !== "undefined")||(typeof ($scope.individu.education.langue.find(x => x.id === '14')) !== "undefined")) && ($scope.individu.education.langue.length > 1)) {
                            state = false;
                            $.toast({
                                heading: 'Incoherence',
                                text: 'Incoherence au niveau de la langue.',
                                showHideTransition: 'slide',
                                icon: 'error',
                                position: 'top-right'
                            });
                        }

                        if (typeof (individu.education.alleecole) === "undefined") {
                            state = false;
                            $("#error_alleecole").show();
                        }
                        if (typeof (individu.education.frequenteecole) === "undefined" && $scope.frequenteecole_show === true) {
                            state = false;
                            $("#error_frequenteecole").show();
                        }
                        if (typeof (individu.education.classe) === "undefined" && $scope.classe_show === true) {
                            state = false;
                            $("#error_classe").show();
                        }
                        if (typeof (individu.education.raisonnonfrequentationecole) === "undefined" && $scope.raisonnonfrequentationecole === true) {
                            state = false;
                            $("#error_raisonnonfrequentationecole").show();
                        }

                    }

                    if (section === 4 && typeof individu.emploi === "undefined") {
                        $("#error_situationoccupation").show();

                    }
                    else if (section === 4 && typeof individu.emploi !== "undefined") {
                        $scope.individu_not_selected = true;
                        if (typeof (individu.emploi.situationoccupation) === "undefined") {
                            state = false;
                            $("#error_situationoccupation").show();
                        }
                        if (typeof (individu.emploi.activiteprincipale) === "undefined" && $scope.emploi === true) {
                            state = false;
                            $("#error_activiteprincipale").show();
                        }
                        if (typeof (individu.emploi.situationactivite) === "undefined" && $scope.emploi === true) {
                            state = false;
                            $("#error_situationactivite").show();
                        }
                        if (typeof (individu.emploi.autreactivite) === "undefined" && $scope.activite_secondaire_show === true) {
                            state = false;
                            $("#error_autreactivite").show();
                        }

                    }

                    if (state === true) {
                        $scope.individu_not_selected = false;
                        $(".section1").hide();
                        $(".section2").hide();
                        $(".section3").hide();
                        $(".section4").hide();
                        $scope.datearrive_show = false;
                        $scope.matrimoniale_show = false;
                        $scope.chef_menage_selected = false;
                        $scope.nina_show = false;
                        $scope.parente_show = true;
                        $scope.maladie_choice = null;
                        $scope.handicap_choice = null;
                        if (typeof individu.id != 'undefined') {
                            var index = functiontofindIndexByKeyValue(list_individu, "id", individu.id);

                            list_individu.splice(index, 1);
                            list_individu.splice(index, 0, individu);
                            $scope.individus = list_individu;
                        } else {
                            var duplicateIndiv = false;
                            angular.forEach(list_individu, function (indiv, key) {
                                if ((individu.demographique.nom == indiv.demographique.nom) && (individu.demographique.prenom == indiv.demographique.prenom) && (individu.demographique.date_naissance == indiv.demographique.date_naissance) && (individu.demographique.parente.id == indiv.demographique.parente.id)) {
                                    duplicateIndiv = true;
                                }
                            });
                            console.log(list_individu);
                            if (!duplicateIndiv) {
                                nbr_individu++;
                                individu.id = nbr_individu;
                                list_individu.push(individu);
                                $scope.individus = list_individu;
                                age = calcAge(individu.demographique.date_naissance);
                                if (age > 6) {
                                    $scope.individusplussix.push(individu);
                                }
                            } else {
                                $.toast({
                                    heading: 'Individu existant',
                                    text: 'L\'individu existe dans le menage.',
                                    showHideTransition: 'slide',
                                    icon: 'warning',
                                    position: 'top-right'
                                });
                            }
                        }
                        //(list_individu);
                        $scope.chefmenage = false;
                        $scope.remplacant = false;
                        $scope.rep = false;


                        angular.forEach(list_individu, function (individu, key) {
                            if (typeof individu.demographique.role !== "undefined") {
                                if (individu.demographique.role == 1) {
                                    $scope.chefmenage = true;
                                }
                                if (individu.demographique.role == 2) {
                                    $scope.remplacant = true;
                                }
                                if (individu.demographique.repondant == true) {
                                    $scope.rep = true;
                                }
                            }

                        });

                        $scope.individu = {};
                        $scope.individu_form.$setPristine(true);
                        $(".demographique").select2('val', '');
                    }


                };


                function functiontofindIndexByKeyValue(arraytosearch, key, valuetosearch) {

                    for (var i = 0; i < arraytosearch.length; i++) {

                        if (arraytosearch[i][key] == valuetosearch) {
                            return i;
                        }
                    }
                    return null;
                }


                $scope.show_individu = function (individu) {

                };


                function calcAge(dateString) {
                    if (dateString.offset != undefined) {
                        var t = new Date(dateString.timestamp);
                        var month = t.getMonth();
                        var date = t.getDate() + '-' + month + '-' + t.getFullYear();
                        $scope.indiv.demographique.date_naissance = date;
                        return ~~((Date.now() - t) / (31557600000));

                    }
                    date = dateString.split("-");
                    date_new = new Date(date[2], date[1] - 1, date[0]);
                    var birthday = +date_new;
                    return ~~((Date.now() - birthday) / (31557600000));
                }


                $scope.formsubmit = function () {
                    $(".spinme").show();
                    $scope.sendurl = window.wsurl + '/enquete/new';
                    $http.post($scope.sendurl, {
                        "titre": $scope.titre,
                        "projet": $scope.projet,
                        "date_d": $scope.date_d,
                        "date_f": $scope.date_f,
                        "enqueteur": $scope.enqueteur,
                        "desc": $scope.desc,
                        token: localStorage.token
                    }).success(function (response) {
                        $(".spinme").hide();
                        $.toast({
                            heading: 'Enregistrement Avec Succès',
                            text: 'Enquête Enregistrée Avec Succès.',
                            showHideTransition: 'slide',
                            icon: 'success',
                            position: 'top-right'
                        });
                        $location.url('\enquete');
                    });


                }


            }
            else {
                $location.url('/enquete');
            }
        });

        $scope.show_depense_alimentation = function (value, depense) {
            $("#error_depensealimentaire" + depense + "consommation").hide();

            if (value == 1) {
                $scope["depense_" + depense + "_show"] = false;
            }
            if (value == 2) {
                $scope["depense_" + depense + "_show"] = true;
            }

        };

        $scope.ctrlConsommationAlimentaire = function (produit) {

            $scope[produit + 'AlimentCons_show'] = false;
            if (typeof ($scope.menage.consoalimentaire[produit].consohier) !== "undefined") {
                $("#error_consoalimentaire" + produit + "consohier").hide();
            }
            $scope['requiredConsommationAlimentaire' + produit + 'Source'] = true;
            if ($scope.menage.consoalimentaire[produit].consohier == 1) {
                $scope["consommer_" + produit] = false;
                $scope['minNbrjour' + produit] = 1;
                $scope['maxNbrjour' + produit] = 7;
            } else if ($scope.menage.consoalimentaire[produit].consohier == 2) {
                $scope['minNbrjour' + produit] = 0;
                $scope['maxNbrjour' + produit] = 6;
                if ($scope.menage.consoalimentaire[produit].nbrjour == 0) {
                    $scope["consommer_" + produit] = true;
                    $scope[produit + 'AlimentCons_show'] = true;
                    $scope['requiredConsommationAlimentaire' + produit + 'Source'] = false;
                    $scope.menage.consoalimentaire[produit].source = undefined;

                    if (produit == "viandes") {
                        var sousViandesArray = ["viande", "foie", "poisson", "oeuf"];
                        sousViandesArray.forEach(function (sousViande) {
                            if (typeof ($scope.menage.consoalimentaire[sousViande]) !== "undefined") {
                                $scope.menage.consoalimentaire[sousViande].consohier = 2;
                                $scope.menage.consoalimentaire[sousViande].nbrjour = 0;
                                $scope['minNbrjour' + sousViande] = 0;
                                $scope['maxNbrjour' + sousViande] = 6;
                                $scope[sousViande + 'AlimentCons_show'] = true;
                                $scope['requiredConsommationAlimentaire' + sousViande + 'Source'] = false;
                                $scope.menage.consoalimentaire[sousViande].source = undefined;
                            }
                        });

                    }
                    if (produit == "legume") {
                        var sousLegumeArray = ["legumeorange", "legumeverte"];
                        sousLegumeArray.forEach(function (sousLegume) {
                            if (typeof ($scope.menage.consoalimentaire[sousLegume]) !== "undefined") {
                                $scope.menage.consoalimentaire[sousLegume].consohier = 2;
                                $scope.menage.consoalimentaire[sousLegume].nbrjour = 0;
                                $scope['minNbrjour' + sousLegume] = 0;
                                $scope['maxNbrjour' + sousLegume] = 6;
                                $scope[sousLegume + 'AlimentCons_show'] = true;
                                $scope['requiredConsommationAlimentaire' + sousLegume + 'Source'] = false;
                                $scope.menage.consoalimentaire[sousLegume].source = undefined;
                            }
                        });
                    }
                    if (produit == "fruit") {
                        if (typeof ($scope.menage.consoalimentaire.fruitorange) !== "undefined") {
                            $scope.menage.consoalimentaire.fruitorange.consohier = 2;
                            $scope.menage.consoalimentaire.fruitorange.nbrjour = 0;
                            $scope.minNbrjourfruitorange = 0;
                            $scope.maxNbrjourfruitorange = 6;
                            $scope.fruitorangeAlimentCons_show = true;
                            $scope.requiredConsommationAlimentairefruitorangeSource = false;
                            $scope.menage.consoalimentaire.fruitorange.source = undefined;
                        }
                    }

                } else {
                    $scope["consommer_" + produit] = false;
                }
            }

        };

        $scope.hide_required = function (selectedField) {
            $("#error_" + selectedField).hide();
        };

        $scope.hide_regex = function () {
            var nina_regex = new RegExp('(1|2)[0-9]{13}[a-zA-Z]{1}|(1|2)[0-9]{2}[a-zA-Z]{2}[0-9]{9}[a-zA-Z]{1}');
            nina_regex_match = nina_regex.test($('#nina').val());
            if (nina_regex_match) {
                $("#error_nina_regex").hide();
            } else {
                $("#error_nina_regex").show();
            }
        };


        $scope.change_source_approvisionnement = function (source) {
            var sources = ['5', '6', '7', '96'];
            if (sources.indexOf(source.code) != -1) {
                $scope.show_commodite_eausaine = true;
            } else {
                $scope.show_commodite_eausaine = false;
            }
        };

        $scope.show_animaux_function = function (value) {

            if (value == 2) {
                $scope.show_animaux = false;
            } else {
                $scope.show_animaux = true;
            }

        };

        $scope.maladie = function () {
            if ($scope.individu.sante.maladie_choice == 1) {
                $scope.maladie_show = true;
            } else {
                $scope.maladie_show = false;
                $("#maladie").select2('val', '');
                $scope.individu.sante.maladie = undefined;
            }


        };

        $scope.handicap = function () {
            if ($scope.individu.sante.handicap_choice == 1) {
                $scope.handicap_show = true;
            } else {
                $scope.handicap_show = false;
                $("#handicap").select2('val', '');
                $scope.individu.sante.handicap = undefined;
            }

        };

        $scope.show_picture = function (id) {

            if (id == 1) {
                $scope.chef_menage_selected = true;
                $scope.parente_show = false;
            } else {
                $scope.chef_menage_selected = false;
                $scope.parente_show = true;
            }

        };

        $scope.lien_parente = function (individu) {

            chef_menage = null;
            angular.forEach($scope.individus, function (individu, key) {
                if (typeof individu.demographique.role !== "undefined") {
                    if (individu.demographique.role == 1) {
                        chef_menage = individu;
                    }
                }

            });

            if (chef_menage != null && chef_menage.demographique.sexe == 1) {
                if (typeof individu.demographique.parente.id !== "undefined") {
                    if (individu.demographique.parente.id == 2) {
                        individu.demographique.sexe = 2;

                        individu.demographique.matrimoniale = chef_menage.demographique.matrimoniale;
                        $("#matrimoniale").select2('val', chef_menage.demographique.matrimoniale.id);
                    } else if (individu.demographique.parente.id == 3) {
                        individu.demographique.nom = chef_menage.demographique.nom;
                        individu.demographique.ethnie = chef_menage.demographique.ethnie;
                        if (typeof chef_menage.demographique.ethnie !== "undefined") {
                            $("#ethnie").select2('val', chef_menage.demographique.ethnie.id);
                        }
                    }
                }
            } else if (chef_menage != null && chef_menage.demographique.sexe == 2) {
                if (individu.demographique.parente.id == 2) {
                    individu.demographique.sexe = 1;

                    individu.demographique.matrimoniale = chef_menage.demographique.matrimoniale;
                    $("#matrimoniale").select2('val', chef_menage.demographique.matrimoniale.id);
                }
            }

        };

        $scope.backToListOfMenage = function () {
            $window.history.back();
        };
    }]);

app.controller('showMenageResultCtrl', ['$scope', '$http', '$route', '$location', "DTOptionsBuilder", "DTColumnBuilder",
    "DTDefaultOptions", "DTColumnDefBuilder", "$compile", '$rootScope', '$routeParams', '$window', 'AppFactory', 'Status', 'envService',
    function ($scope, $http, $route, $location, DTOptionsBuilder, DTColumnBuilder, DTDefaultOptions, DTColumnDefBuilder, $compile, $rootScope, $routeParams, $window, AppFactory, Status, envService) {
        $scope.cb1 = true;
        $(".spinme").show();
        $scope.motif = "";

        $scope.isAddNewSurveyBtnVisible = false;
        $scope.isActionBtnVisible = false;
        function toggleAll(selectAll, selectedItems) {
            for (var id in selectedItems) {
                if (selectedItems.hasOwnProperty(id)) {
                    selectedItems[id] = selectAll;
                }
            }
        }

        function toggleOne() {
            selectedItems = $scope.selected;
            console.log($scope);
            for (var id in selectedItems) {
                if (selectedItems.hasOwnProperty(id)) {
                    if (!selectedItems[id]) {
                        $scope.selectAll = false;
                        return;
                    }
                }
            }
            $scope.selectAll = true;
        }

        var getEnq = function () {return envService.is('production')? 'enq' : 'Enq';};
        var getPrenom = function () {return envService.is('production')? 'prenom' : 'Prenom';};
        var getRegion = function () {return envService.is('production')? 'region' : 'Region';};
        var getCercle = function () {return envService.is('production')? 'cercle' : 'Cercle';};
        var getCommune = function () {return envService.is('production')? 'commune' : 'Commune';};
        var getVill = function () {return envService.is('production')? 'vill' : 'Vill';};

        $scope.toggleOne = toggleOne;
        $scope.toggleAll = toggleAll;
        $(document).ready(function () {
            $scope.search_id = $routeParams.search_id;
            var table = $('#list-menage-result').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": window.wsurl + '/enquete/get_menage_for_search',
                    "type": "POST",
                    "data": {token: localStorage.token, search: $scope.search_id},
                },
                "pagingType": "full_numbers",
                "columns": [
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            return '<center><input type="checkbox" name="selected[]" value="' + data + '" ng-model="selected[' + data + ']" ></center>';
                        }
                    },
                    {
                        "data": "id",
                        "render": function (data, type, row, meta) {
                            if((window.userId == _.toNumber(row.utilisateur) && _.toNumber(row.etat) == 1) || localStorage.role == 1 || localStorage.role == 2) {
                                return '<a href="#/showMenage/' + data + '" class="lien">Ménage N:' + data + '</a>';
                            } else {
                                return 'Ménage N:' + data;
                            }
                        }
                    },
                    {"data": getEnq()},
                    {"data": getPrenom()},
                    {"data": "numeromenage"},
                    {"data": getRegion()},
                    {"data": getCercle()},
                    {"data": getCommune()},
                    {"data": getVill()},
                    {"data": "date"},
                    {
                        "data": "etat",
                        "render": function (data, type, row, meta) {
                            var status = AppFactory.findStatusByCode(data);
                            status = _.isEmpty(status) ? Status[0] : status[0];
                            return status.label;
                        }
                    },
                ]
            });
            $(".spinme").hide();
        });
    }]);

