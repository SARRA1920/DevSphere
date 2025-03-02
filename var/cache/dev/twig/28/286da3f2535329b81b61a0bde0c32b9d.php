<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* admin/exercice/index.html.twig */
class __TwigTemplate_a8b3af7877aeec8c152c6d69dbb76779 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
            'javascripts' => [$this, 'block_javascripts'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "admin/base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/exercice/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/exercice/index.html.twig"));

        $this->parent = $this->loadTemplate("admin/base.html.twig", "admin/exercice/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Liste des exercices";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "content"));

        // line 6
        yield "    <div class=\"container-fluid\">
        <div class=\"card shadow mb-4\">
            <div class=\"card-header py-3 d-flex justify-content-between align-items-center\">
                <h6 class=\"m-0 font-weight-bold text-primary\">Liste des exercices</h6>
                <a href=\"";
        // line 10
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_new");
        yield "\" class=\"btn btn-primary\">
                    <i class=\"fas fa-plus\"></i> Nouvel exercice
                </a>
            </div>
            <div class=\"card-body\">
                <div class=\"mb-3\">
                    <form method=\"get\" class=\"form-inline justify-content-end\">
                        <div class=\"input-group\">
                            <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"Rechercher...\" value=\"";
        // line 18
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 18, $this->source); })()), "html", null, true);
        yield "\">
                            <div class=\"input-group-append\">
                                <button class=\"btn btn-primary\" type=\"submit\">
                                    <i class=\"fas fa-search\"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class=\"table-responsive\">
                    <table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">
                        <thead>
                            <tr>
                                <th>
                                    <a href=\"";
        // line 32
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_index", ["sort" => "id", "order" => ((((        // line 34
(isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 34, $this->source); })()) == "id") && ((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 34, $this->source); })()) == "asc"))) ? ("desc") : ("asc")), "search" =>         // line 35
(isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 35, $this->source); })())]), "html", null, true);
        // line 36
        yield "\" class=\"text-dark\">
                                        ID
                                        ";
        // line 38
        if (((isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 38, $this->source); })()) == "id")) {
            // line 39
            yield "                                            <i class=\"fas fa-sort-";
            yield ((((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 39, $this->source); })()) == "asc")) ? ("up") : ("down"));
            yield "\"></i>
                                        ";
        }
        // line 41
        yield "                                    </a>
                                </th>
                                <th>
                                    <a href=\"";
        // line 44
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_index", ["sort" => "titre", "order" => ((((        // line 46
(isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 46, $this->source); })()) == "titre") && ((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 46, $this->source); })()) == "asc"))) ? ("desc") : ("asc")), "search" =>         // line 47
(isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 47, $this->source); })())]), "html", null, true);
        // line 48
        yield "\" class=\"text-dark\">
                                        Titre
                                        ";
        // line 50
        if (((isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 50, $this->source); })()) == "titre")) {
            // line 51
            yield "                                            <i class=\"fas fa-sort-";
            yield ((((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 51, $this->source); })()) == "asc")) ? ("up") : ("down"));
            yield "\"></i>
                                        ";
        }
        // line 53
        yield "                                    </a>
                                </th>
                                <th>
                                    <a href=\"";
        // line 56
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_index", ["sort" => "niveauDifficulte", "order" => ((((        // line 58
(isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 58, $this->source); })()) == "niveauDifficulte") && ((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 58, $this->source); })()) == "asc"))) ? ("desc") : ("asc")), "search" =>         // line 59
(isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 59, $this->source); })())]), "html", null, true);
        // line 60
        yield "\" class=\"text-dark\">
                                        Niveau
                                        ";
        // line 62
        if (((isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 62, $this->source); })()) == "niveauDifficulte")) {
            // line 63
            yield "                                            <i class=\"fas fa-sort-";
            yield ((((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 63, $this->source); })()) == "asc")) ? ("up") : ("down"));
            yield "\"></i>
                                        ";
        }
        // line 65
        yield "                                    </a>
                                </th>
                                <th>
                                    <a href=\"";
        // line 68
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_index", ["sort" => "noteMinimale", "order" => ((((        // line 70
(isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 70, $this->source); })()) == "noteMinimale") && ((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 70, $this->source); })()) == "asc"))) ? ("desc") : ("asc")), "search" =>         // line 71
(isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 71, $this->source); })())]), "html", null, true);
        // line 72
        yield "\" class=\"text-dark\">
                                        Note minimale
                                        ";
        // line 74
        if (((isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 74, $this->source); })()) == "noteMinimale")) {
            // line 75
            yield "                                            <i class=\"fas fa-sort-";
            yield ((((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 75, $this->source); })()) == "asc")) ? ("up") : ("down"));
            yield "\"></i>
                                        ";
        }
        // line 77
        yield "                                    </a>
                                </th>
                                <th>
                                    <a href=\"";
        // line 80
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_index", ["sort" => "tempsEstime", "order" => ((((        // line 82
(isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 82, $this->source); })()) == "tempsEstime") && ((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 82, $this->source); })()) == "asc"))) ? ("desc") : ("asc")), "search" =>         // line 83
(isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 83, $this->source); })())]), "html", null, true);
        // line 84
        yield "\" class=\"text-dark\">
                                        Temps estimé
                                        ";
        // line 86
        if (((isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 86, $this->source); })()) == "tempsEstime")) {
            // line 87
            yield "                                            <i class=\"fas fa-sort-";
            yield ((((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 87, $this->source); })()) == "asc")) ? ("up") : ("down"));
            yield "\"></i>
                                        ";
        }
        // line 89
        yield "                                    </a>
                                </th>
                                <th>
                                    <a href=\"";
        // line 92
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_index", ["sort" => "type", "order" => ((((        // line 94
(isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 94, $this->source); })()) == "type") && ((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 94, $this->source); })()) == "asc"))) ? ("desc") : ("asc")), "search" =>         // line 95
(isset($context["searchTerm"]) || array_key_exists("searchTerm", $context) ? $context["searchTerm"] : (function () { throw new RuntimeError('Variable "searchTerm" does not exist.', 95, $this->source); })())]), "html", null, true);
        // line 96
        yield "\" class=\"text-dark\">
                                        Type
                                        ";
        // line 98
        if (((isset($context["sortField"]) || array_key_exists("sortField", $context) ? $context["sortField"] : (function () { throw new RuntimeError('Variable "sortField" does not exist.', 98, $this->source); })()) == "type")) {
            // line 99
            yield "                                            <i class=\"fas fa-sort-";
            yield ((((isset($context["sortOrder"]) || array_key_exists("sortOrder", $context) ? $context["sortOrder"] : (function () { throw new RuntimeError('Variable "sortOrder" does not exist.', 99, $this->source); })()) == "asc")) ? ("up") : ("down"));
            yield "\"></i>
                                        ";
        }
        // line 101
        yield "                                    </a>
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        ";
        // line 107
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["exercices"]) || array_key_exists("exercices", $context) ? $context["exercices"] : (function () { throw new RuntimeError('Variable "exercices" does not exist.', 107, $this->source); })()));
        $context['_iterated'] = false;
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["exercice"]) {
            // line 108
            yield "                            <tr>
                                <td>";
            // line 109
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 109), "html", null, true);
            yield "</td>
                                <td>";
            // line 110
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "titre", [], "any", false, false, false, 110), "html", null, true);
            yield "</td>
                                <td>";
            // line 111
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 111), "html", null, true);
            yield "</td>
                                <td>";
            // line 112
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "noteMinimale", [], "any", false, false, false, 112), "html", null, true);
            yield "</td>
                                <td>";
            // line 113
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "tempsEstime", [], "any", false, false, false, 113), "html", null, true);
            yield " min</td>
                                <td>";
            // line 114
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "typeExercice", [], "any", false, false, false, 114), "html", null, true);
            yield "</td>
                                <td>
                                    <div class=\"btn-group\" role=\"group\">
                                        <a href=\"";
            // line 117
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 117)]), "html", null, true);
            yield "\" class=\"btn btn-info btn-sm\">
                                            <i class=\"fas fa-eye\"></i>
                                        </a>
                                        <a href=\"";
            // line 120
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 120)]), "html", null, true);
            yield "\" class=\"btn btn-warning btn-sm\">
                                            <i class=\"fas fa-edit\"></i>
                                        </a>
                                        ";
            // line 123
            yield Twig\Extension\CoreExtension::include($this->env, $context, "admin/exercice/_delete_form.html.twig");
            yield "
                                    </div>
                                </td>
                            </tr>
                        ";
            $context['_iterated'] = true;
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['revindex0'], $context['loop']['revindex'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        // line 131
        if (!$context['_iterated']) {
            // line 128
            yield "                            <tr>
                                <td colspan=\"7\" class=\"text-center\">Aucun exercice trouvé</td>
                            </tr>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['exercice'], $context['_parent'], $context['_iterated'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 132
        yield "                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 140
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 141
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        \$(document).ready(function() {
            \$('#dataTable').DataTable({
                \"language\": {
                    \"url\": \"//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json\"
                }
            });
        });
    </script>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "admin/exercice/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  381 => 141,  368 => 140,  351 => 132,  342 => 128,  340 => 131,  323 => 123,  317 => 120,  311 => 117,  305 => 114,  301 => 113,  297 => 112,  293 => 111,  289 => 110,  285 => 109,  282 => 108,  264 => 107,  256 => 101,  250 => 99,  248 => 98,  244 => 96,  242 => 95,  241 => 94,  240 => 92,  235 => 89,  229 => 87,  227 => 86,  223 => 84,  221 => 83,  220 => 82,  219 => 80,  214 => 77,  208 => 75,  206 => 74,  202 => 72,  200 => 71,  199 => 70,  198 => 68,  193 => 65,  187 => 63,  185 => 62,  181 => 60,  179 => 59,  178 => 58,  177 => 56,  172 => 53,  166 => 51,  164 => 50,  160 => 48,  158 => 47,  157 => 46,  156 => 44,  151 => 41,  145 => 39,  143 => 38,  139 => 36,  137 => 35,  136 => 34,  135 => 32,  118 => 18,  107 => 10,  101 => 6,  88 => 5,  65 => 3,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/base.html.twig' %}

{% block title %}Liste des exercices{% endblock %}

{% block content %}
    <div class=\"container-fluid\">
        <div class=\"card shadow mb-4\">
            <div class=\"card-header py-3 d-flex justify-content-between align-items-center\">
                <h6 class=\"m-0 font-weight-bold text-primary\">Liste des exercices</h6>
                <a href=\"{{ path('admin_exercice_new') }}\" class=\"btn btn-primary\">
                    <i class=\"fas fa-plus\"></i> Nouvel exercice
                </a>
            </div>
            <div class=\"card-body\">
                <div class=\"mb-3\">
                    <form method=\"get\" class=\"form-inline justify-content-end\">
                        <div class=\"input-group\">
                            <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"Rechercher...\" value=\"{{ searchTerm }}\">
                            <div class=\"input-group-append\">
                                <button class=\"btn btn-primary\" type=\"submit\">
                                    <i class=\"fas fa-search\"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class=\"table-responsive\">
                    <table class=\"table table-bordered\" id=\"dataTable\" width=\"100%\" cellspacing=\"0\">
                        <thead>
                            <tr>
                                <th>
                                    <a href=\"{{ path('admin_exercice_index', {
                                        'sort': 'id',
                                        'order': sortField == 'id' and sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search': searchTerm
                                    }) }}\" class=\"text-dark\">
                                        ID
                                        {% if sortField == 'id' %}
                                            <i class=\"fas fa-sort-{{ sortOrder == 'asc' ? 'up' : 'down' }}\"></i>
                                        {% endif %}
                                    </a>
                                </th>
                                <th>
                                    <a href=\"{{ path('admin_exercice_index', {
                                        'sort': 'titre',
                                        'order': sortField == 'titre' and sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search': searchTerm
                                    }) }}\" class=\"text-dark\">
                                        Titre
                                        {% if sortField == 'titre' %}
                                            <i class=\"fas fa-sort-{{ sortOrder == 'asc' ? 'up' : 'down' }}\"></i>
                                        {% endif %}
                                    </a>
                                </th>
                                <th>
                                    <a href=\"{{ path('admin_exercice_index', {
                                        'sort': 'niveauDifficulte',
                                        'order': sortField == 'niveauDifficulte' and sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search': searchTerm
                                    }) }}\" class=\"text-dark\">
                                        Niveau
                                        {% if sortField == 'niveauDifficulte' %}
                                            <i class=\"fas fa-sort-{{ sortOrder == 'asc' ? 'up' : 'down' }}\"></i>
                                        {% endif %}
                                    </a>
                                </th>
                                <th>
                                    <a href=\"{{ path('admin_exercice_index', {
                                        'sort': 'noteMinimale',
                                        'order': sortField == 'noteMinimale' and sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search': searchTerm
                                    }) }}\" class=\"text-dark\">
                                        Note minimale
                                        {% if sortField == 'noteMinimale' %}
                                            <i class=\"fas fa-sort-{{ sortOrder == 'asc' ? 'up' : 'down' }}\"></i>
                                        {% endif %}
                                    </a>
                                </th>
                                <th>
                                    <a href=\"{{ path('admin_exercice_index', {
                                        'sort': 'tempsEstime',
                                        'order': sortField == 'tempsEstime' and sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search': searchTerm
                                    }) }}\" class=\"text-dark\">
                                        Temps estimé
                                        {% if sortField == 'tempsEstime' %}
                                            <i class=\"fas fa-sort-{{ sortOrder == 'asc' ? 'up' : 'down' }}\"></i>
                                        {% endif %}
                                    </a>
                                </th>
                                <th>
                                    <a href=\"{{ path('admin_exercice_index', {
                                        'sort': 'type',
                                        'order': sortField == 'type' and sortOrder == 'asc' ? 'desc' : 'asc',
                                        'search': searchTerm
                                    }) }}\" class=\"text-dark\">
                                        Type
                                        {% if sortField == 'type' %}
                                            <i class=\"fas fa-sort-{{ sortOrder == 'asc' ? 'up' : 'down' }}\"></i>
                                        {% endif %}
                                    </a>
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        {% for exercice in exercices %}
                            <tr>
                                <td>{{ exercice.id }}</td>
                                <td>{{ exercice.titre }}</td>
                                <td>{{ exercice.niveauDifficulte }}</td>
                                <td>{{ exercice.noteMinimale }}</td>
                                <td>{{ exercice.tempsEstime }} min</td>
                                <td>{{ exercice.typeExercice }}</td>
                                <td>
                                    <div class=\"btn-group\" role=\"group\">
                                        <a href=\"{{ path('admin_exercice_show', {'id': exercice.id}) }}\" class=\"btn btn-info btn-sm\">
                                            <i class=\"fas fa-eye\"></i>
                                        </a>
                                        <a href=\"{{ path('admin_exercice_edit', {'id': exercice.id}) }}\" class=\"btn btn-warning btn-sm\">
                                            <i class=\"fas fa-edit\"></i>
                                        </a>
                                        {{ include('admin/exercice/_delete_form.html.twig') }}
                                    </div>
                                </td>
                            </tr>
                        {% else %}
                            <tr>
                                <td colspan=\"7\" class=\"text-center\">Aucun exercice trouvé</td>
                            </tr>
                        {% endfor %}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script>
        \$(document).ready(function() {
            \$('#dataTable').DataTable({
                \"language\": {
                    \"url\": \"//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json\"
                }
            });
        });
    </script>
{% endblock %}
", "admin/exercice/index.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\admin\\exercice\\index.html.twig");
    }
}
