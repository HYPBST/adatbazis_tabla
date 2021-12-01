<?php


use Illuminate\Support\Facades\Response as FacadesResponse;
use Adatbazis\Tabla\Film;
use Adatbazis\Tabla\Felhasznalo;
use Adatbazis\Tabla\Ertekeles;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response as Psr7Response;

return function(Slim\App $app) {
    $app->get('/filmek', function(Request $request, Response $response) {
        $Filmek = Film::get();
        $kimenet = $Filmek->toJson();

        $response->getBody()->write($kimenet);
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->post('/filmek', function(Request $request, Response $response) {
        $input = json_decode($request->getBody(), true);
        $film = Film::create($input);
        $film->save();

        $kimenet = $film->toJson();
        
        $response->getBody()->write($kimenet);
        return $response
            ->withStatus(201) // "Created" status code
            ->withHeader('Content-Type', 'application/json');
    });

    $app->delete('/filmek/{id}',
        function (Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $film = Film::find($args['id']);
            if ($film === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű Film']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $film->delete();
            return $response
                ->withStatus(204);
        });

    $app->put('/filmek/{id}',
        function(Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $film = Film::find($args['id']);
            if ($film === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű Film']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $input = json_decode($request->getBody(), true);
            $film->fill($input);
            $film->save();
            $response->getBody()->write($film->toJson());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });

    $app->get('/filmek/{id}',
        function(Request $request, Response $response, array $args) {
            if (!is_numeric($args['id']) || $args['id'] <= 0) {
                $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(400);
            }
            $film = Film::find($args['id']);
            if ($film === null) {
                $ki = json_encode(['error' => 'Nincs ilyen ID-jű Film']);
                $response->getBody()->write($ki);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            $response->getBody()->write($film->toJson());
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });
        $app->get('/felhasznalo', function(Request $request, Response $response) {
            $felhasznalo =Felhasznalo::get();
            $kimenet = $felhasznalo->toJson();
    
            $response->getBody()->write($kimenet);
            return $response->withHeader('Content-Type', 'application/json');
        });
    
        $app->post('/felhasznalo', function(Request $request, Response $response) {
            $input = json_decode($request->getBody(), true);
            $felhasznalo =Felhasznalo::create($input);
            $felhasznalo->save();
    
            $kimenet = $felhasznalo->toJson();
            
            $response->getBody()->write($kimenet);
            return $response
                ->withStatus(201) // "Created" status code
                ->withHeader('Content-Type', 'application/json');
        });
    
        $app->delete('/felhasznalo/{id}',
            function (Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $felhasznalo =Felhasznalo::find($args['id']);
                if ($felhasznalo === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jűFelhasznalo']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $felhasznalo->delete();
                return $response
                    ->withStatus(204);
            });
    
        $app->put('/felhasznalo/{id}',
            function(Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $felhasznalo =Felhasznalo::find($args['id']);
                if ($felhasznalo === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jűFelhasznalo']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $input = json_decode($request->getBody(), true);
                $felhasznalo->fill($input);
                $felhasznalo->save();
                $response->getBody()->write($felhasznalo->toJson());
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
            });
    
        $app->get('/felhasznalo/{id}',
            function(Request $request, Response $response, array $args) {
                if (!is_numeric($args['id']) || $args['id'] <= 0) {
                    $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(400);
                }
                $felhasznalo =Felhasznalo::find($args['id']);
                if ($felhasznalo === null) {
                    $ki = json_encode(['error' => 'Nincs ilyen ID-jűFelhasznalo']);
                    $response->getBody()->write($ki);
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(404);
                }
                $response->getBody()->write($felhasznalo->toJson());
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
            });
            $app->get('/ertekelesek', function(Request $request, Response $response) {
                $ertekelesek = Ertekeles::get();
                $kimenet = $ertekelesek->toJson();
        
                $response->getBody()->write($kimenet);
                return $response->withHeader('Content-Type', 'application/json');
            });
        
            $app->post('/ertekelesek', function(Request $request, Response $response) {
                $input = json_decode($request->getBody(), true);
                $Ertekeles = Ertekeles::create($input);
                $Ertekeles->save();
        
                $kimenet = $Ertekeles->toJson();
                
                $response->getBody()->write($kimenet);
                return $response
                    ->withStatus(201) // "Created" status code
                    ->withHeader('Content-Type', 'application/json');
            });
        
            $app->delete('/ertekelesek/{id}',
                function (Request $request, Response $response, array $args) {
                    if (!is_numeric($args['id']) || $args['id'] <= 0) {
                        $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                        $response->getBody()->write($ki);
                        return $response
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(400);
                    }
                    $Ertekeles = Ertekeles::find($args['id']);
                    if ($Ertekeles === null) {
                        $ki = json_encode(['error' => 'Nincs ilyen ID-jű Ertekeles']);
                        $response->getBody()->write($ki);
                        return $response
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(404);
                    }
                    $Ertekeles->delete();
                    return $response
                        ->withStatus(204);
                });
        
            $app->put('/ertekelesek/{id}',
                function(Request $request, Response $response, array $args) {
                    if (!is_numeric($args['id']) || $args['id'] <= 0) {
                        $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                        $response->getBody()->write($ki);
                        return $response
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(400);
                    }
                    $Ertekeles = Ertekeles::find($args['id']);
                    if ($Ertekeles === null) {
                        $ki = json_encode(['error' => 'Nincs ilyen ID-jű Ertekeles']);
                        $response->getBody()->write($ki);
                        return $response
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(404);
                    }
                    $input = json_decode($request->getBody(), true);
                    $Ertekeles->fill($input);
                    $Ertekeles->save();
                    $response->getBody()->write($Ertekeles->toJson());
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
                });
        
            $app->get('/ertekelesek/{id}',
                function(Request $request, Response $response, array $args) {
                    if (!is_numeric($args['id']) || $args['id'] <= 0) {
                        $ki = json_encode(['error' => 'Az ID pozitív egész szám kell legyen!']);
                        $response->getBody()->write($ki);
                        return $response
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(400);
                    }
                    $Ertekeles = Ertekeles::find($args['id']);
                    if ($Ertekeles === null) {
                        $ki = json_encode(['error' => 'Nincs ilyen ID-jű Ertekeles']);
                        $response->getBody()->write($ki);
                        return $response
                            ->withHeader('Content-Type', 'application/json')
                            ->withStatus(404);
                    }
                    $response->getBody()->write($Ertekeles->toJson());
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
                });
                $app->get('/ertekelesek/film/',
                function(Response $response) {
                    $ertekelesek = Ertekeles::table('ertekelesek')
                    ->join('filmek', 'filmek.id', '=', 'ertekelesek.film_id')
                    ->select('filmek.cim.*', 'ertekelesek.ertekeles')
                    ->get();
                    $response->getBody()->write($ertekelesek->toJson());
                    return $response
                        ->withHeader('Content-Type', 'application/json')
                        ->withStatus(200);
                });
};
