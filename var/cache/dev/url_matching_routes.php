<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/about' => [[['_route' => 'app_about', '_controller' => 'App\\Controller\\AboutController::index'], null, null, null, false, false, null]],
        '/admin/categorie/cours' => [[['_route' => 'admin_categorie_cours_index', '_controller' => 'App\\Controller\\Admin\\CategorieCoursController::index'], null, ['GET' => 0], null, true, false, null]],
        '/admin/categorie/cours/new' => [[['_route' => 'admin_categorie_cours_new', '_controller' => 'App\\Controller\\Admin\\CategorieCoursController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/cours' => [[['_route' => 'admin_cours_index', '_controller' => 'App\\Controller\\Admin\\CoursController::index'], null, ['GET' => 0], null, true, false, null]],
        '/admin/cours/new' => [[['_route' => 'admin_cours_new', '_controller' => 'App\\Controller\\Admin\\CoursController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin' => [[['_route' => 'admin_dashboard', '_controller' => 'App\\Controller\\Admin\\DashboardController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/exercice' => [[['_route' => 'admin_exercice_index', '_controller' => 'App\\Controller\\Admin\\ExerciceController::index'], null, ['GET' => 0], null, true, false, null]],
        '/admin/exercice/new' => [[['_route' => 'admin_exercice_new', '_controller' => 'App\\Controller\\Admin\\ExerciceController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/tentative' => [[['_route' => 'admin_tentative_index', '_controller' => 'App\\Controller\\Admin\\TentativeController::index'], null, ['GET' => 0], null, true, false, null]],
        '/admin/tentative/new' => [[['_route' => 'admin_tentative_new', '_controller' => 'App\\Controller\\Admin\\TentativeController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/recommendations' => [[['_route' => 'api_get_recommendations', '_controller' => 'App\\Controller\\Api\\RecommendationController::getRecommendations'], null, ['GET' => 0], null, false, false, null]],
        '/cours' => [[['_route' => 'app_cours_index', '_controller' => 'App\\Controller\\CoursController::index'], null, ['GET' => 0], null, true, false, null]],
        '/cours/new' => [[['_route' => 'app_cours_new', '_controller' => 'App\\Controller\\CoursController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/event' => [[['_route' => 'app_event', '_controller' => 'App\\Controller\\EventController::index'], null, null, null, false, false, null]],
        '/exercice' => [[['_route' => 'app_exercice_index', '_controller' => 'App\\Controller\\ExerciceController::index'], null, ['GET' => 0], null, true, false, null]],
        '/exercice/list' => [[['_route' => 'app_exercice_list', '_controller' => 'App\\Controller\\ExerciceController::list'], null, ['GET' => 0], null, false, false, null]],
        '/exercice/new' => [[['_route' => 'app_exercice_new', '_controller' => 'App\\Controller\\ExerciceController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/forum' => [[['_route' => 'app_forum', '_controller' => 'App\\Controller\\ForumController::index'], null, null, null, true, false, null]],
        '/forum/new' => [[['_route' => 'app_forum_new', '_controller' => 'App\\Controller\\ForumController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/home' => [[['_route' => 'app_home', '_controller' => 'App\\Controller\\HomeController::index'], null, null, null, false, false, null]],
        '/inscription' => [[['_route' => 'app_inscription_index', '_controller' => 'App\\Controller\\InscriptionController::index'], null, ['GET' => 0], null, true, false, null]],
        '/inscription/new' => [[['_route' => 'app_inscription_new', '_controller' => 'App\\Controller\\InscriptionController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/categories' => [[['_route' => 'public_categorie_cours_index', '_controller' => 'App\\Controller\\Public\\CategorieCoursController::index'], null, ['GET' => 0], null, true, false, null]],
        '/categorie/cours' => [[['_route' => 'app_categorie_cours_index', '_controller' => 'App\\Controller\\CategorieCoursController::index'], null, ['GET' => 0], null, true, false, null]],
        '/categorie/cours/new' => [[['_route' => 'app_categorie_cours_new', '_controller' => 'App\\Controller\\CategorieCoursController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/publication' => [[['_route' => 'app_publication_index', '_controller' => 'App\\Controller\\PublicationController::index'], null, ['GET' => 0], null, true, false, null]],
        '/publication/new' => [[['_route' => 'app_publication_new', '_controller' => 'App\\Controller\\PublicationController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/reclamation' => [[['_route' => 'app_reclamation', '_controller' => 'App\\Controller\\ReclamationController::index'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, ['POST' => 0], null, false, false, null]],
        '/signup' => [[['_route' => 'app_signup', '_controller' => 'App\\Controller\\SignupController::index'], null, null, null, false, false, null]],
        '/tentative/mes-tentatives' => [[['_route' => 'app_mes_tentatives', '_controller' => 'App\\Controller\\TentativeController::mesTentatives'], null, ['GET' => 0], null, false, false, null]],
        '/user' => [[['_route' => 'app_user', '_controller' => 'App\\Controller\\UserController::index'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/admin/(?'
                    .'|c(?'
                        .'|ategorie/cours/([^/]++)(?'
                            .'|/edit(*:247)'
                            .'|(*:255)'
                        .')'
                        .'|ours/([^/]++)(?'
                            .'|/edit(*:285)'
                            .'|(*:293)'
                        .')'
                    .')'
                    .'|exercice/(?'
                        .'|(\\d+)(*:320)'
                        .'|(\\d+)/edit(*:338)'
                        .'|(\\d+)(*:351)'
                        .'|([^/]++)/pdf(*:371)'
                    .')'
                    .'|tentative/([^/]++)(?'
                        .'|(*:401)'
                        .'|/edit(*:414)'
                        .'|(*:422)'
                    .')'
                .')'
                .'|/c(?'
                    .'|ours/([^/]++)(?'
                        .'|(*:453)'
                        .'|/(?'
                            .'|pdf(*:468)'
                            .'|edit(*:480)'
                            .'|delete(*:494)'
                        .')'
                    .')'
                    .'|ategorie(?'
                        .'|s/([^/]++)(*:525)'
                        .'|/cours/([^/]++)(?'
                            .'|(*:551)'
                            .'|/edit(*:564)'
                            .'|(*:572)'
                        .')'
                    .')'
                .')'
                .'|/exercice/(?'
                    .'|(\\d+)(*:601)'
                    .'|([^/]++)(?'
                        .'|/edit(*:625)'
                        .'|(*:633)'
                    .')'
                    .'|recommendations(*:657)'
                .')'
                .'|/forum/(?'
                    .'|([^/]++)(?'
                        .'|(*:687)'
                        .'|/(?'
                            .'|edit(*:703)'
                            .'|comment(*:718)'
                        .')'
                        .'|(*:727)'
                    .')'
                    .'|comment/([^/]++)/delete(*:759)'
                .')'
                .'|/inscription/([^/]++)(?'
                    .'|(*:792)'
                    .'|/edit(*:805)'
                    .'|(*:813)'
                .')'
                .'|/publication/([^/]++)(?'
                    .'|(*:846)'
                    .'|/(?'
                        .'|edit(*:862)'
                        .'|delete(*:876)'
                    .')'
                .')'
                .'|/tentative/(?'
                    .'|exercice/([^/]++)/(?'
                        .'|submit(*:927)'
                        .'|tentatives(*:945)'
                    .')'
                    .'|resultat/([^/]++)(*:971)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        247 => [[['_route' => 'admin_categorie_cours_edit', '_controller' => 'App\\Controller\\Admin\\CategorieCoursController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        255 => [[['_route' => 'admin_categorie_cours_delete', '_controller' => 'App\\Controller\\Admin\\CategorieCoursController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        285 => [[['_route' => 'admin_cours_edit', '_controller' => 'App\\Controller\\Admin\\CoursController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        293 => [[['_route' => 'admin_cours_delete', '_controller' => 'App\\Controller\\Admin\\CoursController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        320 => [[['_route' => 'admin_exercice_show', '_controller' => 'App\\Controller\\Admin\\ExerciceController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        338 => [[['_route' => 'admin_exercice_edit', '_controller' => 'App\\Controller\\Admin\\ExerciceController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        351 => [[['_route' => 'admin_exercice_delete', '_controller' => 'App\\Controller\\Admin\\ExerciceController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        371 => [[['_route' => 'admin_exercice_pdf', '_controller' => 'App\\Controller\\Admin\\ExerciceController::generatePdf'], ['id'], ['GET' => 0], null, false, false, null]],
        401 => [[['_route' => 'admin_tentative_show', '_controller' => 'App\\Controller\\Admin\\TentativeController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        414 => [[['_route' => 'admin_tentative_edit', '_controller' => 'App\\Controller\\Admin\\TentativeController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        422 => [[['_route' => 'admin_tentative_delete', '_controller' => 'App\\Controller\\Admin\\TentativeController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        453 => [[['_route' => 'app_cours_show', '_controller' => 'App\\Controller\\CoursController::show'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        468 => [[['_route' => 'app_cours_pdf', '_controller' => 'App\\Controller\\CoursController::downloadPdf'], ['id'], ['GET' => 0], null, false, false, null]],
        480 => [[['_route' => 'app_cours_edit', '_controller' => 'App\\Controller\\CoursController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        494 => [[['_route' => 'app_cours_delete', '_controller' => 'App\\Controller\\CoursController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        525 => [[['_route' => 'public_categorie_cours_show', '_controller' => 'App\\Controller\\Public\\CategorieCoursController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        551 => [[['_route' => 'app_categorie_cours_show', '_controller' => 'App\\Controller\\CategorieCoursController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        564 => [[['_route' => 'app_categorie_cours_edit', '_controller' => 'App\\Controller\\CategorieCoursController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        572 => [[['_route' => 'app_categorie_cours_delete', '_controller' => 'App\\Controller\\CategorieCoursController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        601 => [[['_route' => 'app_exercice_show', '_controller' => 'App\\Controller\\ExerciceController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        625 => [[['_route' => 'app_exercice_edit', '_controller' => 'App\\Controller\\ExerciceController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        633 => [[['_route' => 'app_exercice_delete', '_controller' => 'App\\Controller\\ExerciceController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        657 => [[['_route' => 'app_exercice_recommendations', '_controller' => 'App\\Controller\\ExerciceController::recommendations'], [], null, null, false, false, null]],
        687 => [[['_route' => 'app_forum_show', '_controller' => 'App\\Controller\\ForumController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        703 => [[['_route' => 'app_forum_edit', '_controller' => 'App\\Controller\\ForumController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        718 => [[['_route' => 'app_forum_comment', '_controller' => 'App\\Controller\\ForumController::addComment'], ['id'], ['POST' => 0], null, false, false, null]],
        727 => [[['_route' => 'app_forum_delete', '_controller' => 'App\\Controller\\ForumController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        759 => [[['_route' => 'app_forum_comment_delete', '_controller' => 'App\\Controller\\ForumController::deleteComment'], ['id'], ['POST' => 0], null, false, false, null]],
        792 => [[['_route' => 'app_inscription_show', '_controller' => 'App\\Controller\\InscriptionController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        805 => [[['_route' => 'app_inscription_edit', '_controller' => 'App\\Controller\\InscriptionController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        813 => [[['_route' => 'app_inscription_delete', '_controller' => 'App\\Controller\\InscriptionController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        846 => [[['_route' => 'app_publication_show', '_controller' => 'App\\Controller\\PublicationController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        862 => [[['_route' => 'app_publication_edit', '_controller' => 'App\\Controller\\PublicationController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        876 => [[['_route' => 'app_publication_delete', '_controller' => 'App\\Controller\\PublicationController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        927 => [[['_route' => 'app_tentative_submit', '_controller' => 'App\\Controller\\TentativeController::submit'], ['id'], ['POST' => 0], null, false, false, null]],
        945 => [[['_route' => 'app_exercice_tentatives', '_controller' => 'App\\Controller\\TentativeController::tentativesParExercice'], ['id'], ['GET' => 0], null, false, false, null]],
        971 => [
            [['_route' => 'app_tentative_resultat', '_controller' => 'App\\Controller\\TentativeController::resultat'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
