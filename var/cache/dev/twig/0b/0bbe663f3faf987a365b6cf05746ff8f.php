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

/* admin/exercice/show.html.twig */
class __TwigTemplate_3ae5a9fdf95ec1698567d9cadd75100d extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/exercice/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/exercice/show.html.twig"));

        $this->parent = $this->loadTemplate("admin/base.html.twig", "admin/exercice/show.html.twig", 1);
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

        yield "Détails de l'exercice";
        
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
        <h1 class=\"h3 mb-4 text-gray-800\">";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 7, $this->source); })()), "titre", [], "any", false, false, false, 7), "html", null, true);
        yield "</h1>

        <div class=\"card shadow mb-4\">
            <div class=\"card-header py-3 d-flex justify-content-between align-items-center\">
                <h6 class=\"m-0 font-weight-bold text-primary\">Détails de l'exercice</h6>
                <div>
                    <a href=\"";
        // line 13
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_pdf", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 13, $this->source); })()), "id", [], "any", false, false, false, 13)]), "html", null, true);
        yield "\" class=\"btn btn-info btn-sm mr-2\" target=\"_blank\">
                        <i class=\"fas fa-file-pdf\"></i> Télécharger PDF
                    </a>
                    <a href=\"";
        // line 16
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 16, $this->source); })()), "id", [], "any", false, false, false, 16)]), "html", null, true);
        yield "\" class=\"btn btn-warning btn-sm mr-2\">
                        <i class=\"fas fa-edit\"></i> Modifier
                    </a>
                    <a href=\"";
        // line 19
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_index");
        yield "\" class=\"btn btn-secondary btn-sm\">
                        <i class=\"fas fa-arrow-left\"></i> Retour
                    </a>
                </div>
            </div>
            <div class=\"card-body\">
                <div class=\"row\">
                    <div class=\"col-md-8\">
                        <table class=\"table table-bordered\">
                            <tbody>
                                <tr>
                                    <th class=\"bg-light\" style=\"width: 30%\">Titre</th>
                                    <td>";
        // line 31
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 31, $this->source); })()), "titre", [], "any", false, false, false, 31), "html", null, true);
        yield "</td>
                                </tr>
                                <tr>
                                    <th class=\"bg-light\">Type</th>
                                    <td>
                                        <span class=\"badge ";
        // line 36
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 36, $this->source); })()), "typeExercice", [], "any", false, false, false, 36) == "qcm")) {
            yield "bg-info";
        } elseif ((((CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 36, $this->source); })()), "typeExercice", [], "any", false, false, false, 36) == "html") || (CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 36, $this->source); })()), "typeExercice", [], "any", false, false, false, 36) == "javascript")) || (CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 36, $this->source); })()), "typeExercice", [], "any", false, false, false, 36) == "php"))) {
            yield "bg-primary";
        } else {
            yield "bg-secondary";
        }
        yield "\">
                                            ";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 37, $this->source); })()), "typeExercice", [], "any", false, false, false, 37)), "html", null, true);
        yield "
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class=\"bg-light\">Niveau de difficulté</th>
                                    <td>
                                        <span class=\"badge ";
        // line 44
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 44, $this->source); })()), "niveauDifficulte", [], "any", false, false, false, 44) == "facile")) {
            yield "bg-success";
        } elseif ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 44, $this->source); })()), "niveauDifficulte", [], "any", false, false, false, 44) == "moyen")) {
            yield "bg-warning";
        } else {
            yield "bg-danger";
        }
        yield "\">
                                            ";
        // line 45
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 45, $this->source); })()), "niveauDifficulte", [], "any", false, false, false, 45)), "html", null, true);
        yield "
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class=\"bg-light\">Note minimale</th>
                                    <td>";
        // line 51
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 51, $this->source); })()), "noteMinimale", [], "any", false, false, false, 51), "html", null, true);
        yield "/20</td>
                                </tr>
                                <tr>
                                    <th class=\"bg-light\">Temps estimé</th>
                                    <td>";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 55, $this->source); })()), "tempsEstime", [], "any", false, false, false, 55), "html", null, true);
        yield " minutes</td>
                                </tr>
                                <tr>
                                    <th class=\"bg-light\">Créé par</th>
                                    <td>";
        // line 59
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 59, $this->source); })()), "user", [], "any", false, false, false, 59), "name", [], "any", false, false, false, 59), "html", null, true);
        yield "</td>
                                </tr>
                                ";
        // line 61
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 61, $this->source); })()), "fichierPdf", [], "any", false, false, false, 61)) {
            // line 62
            yield "                                <tr>
                                    <th class=\"bg-light\">Fichier PDF</th>
                                    <td>
                                        <a href=\"";
            // line 65
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/exercices/" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 65, $this->source); })()), "fichierPdf", [], "any", false, false, false, 65))), "html", null, true);
            yield "\" target=\"_blank\" class=\"btn btn-primary btn-sm\">
                                            <i class=\"fas fa-file-pdf\"></i> Voir le PDF
                                        </a>
                                    </td>
                                </tr>
                                ";
        }
        // line 71
        yield "                            </tbody>
                        </table>
                    </div>
                    <div class=\"col-md-4\">
                        <div class=\"card\">
                            <div class=\"card-header bg-primary text-white\">
                                <h6 class=\"m-0\">Statistiques</h6>
                            </div>
                            <div class=\"card-body\">
                                <ul class=\"list-group list-group-flush\">
                                    <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                        Tentatives totales
                                        <span class=\"badge bg-primary rounded-pill\">";
        // line 83
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 83, $this->source); })()), "tentatives", [], "any", false, false, false, 83)), "html", null, true);
        yield "</span>
                                    </li>
                                    <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                        Réussites
                                        <span class=\"badge bg-success rounded-pill\">
                                            ";
        // line 88
        $context["successCount"] = 0;
        // line 89
        yield "                                            ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 89, $this->source); })()), "tentatives", [], "any", false, false, false, 89));
        foreach ($context['_seq'] as $context["_key"] => $context["tentative"]) {
            // line 90
            yield "                                                ";
            if ((CoreExtension::getAttribute($this->env, $this->source, $context["tentative"], "note", [], "any", false, false, false, 90) >= CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 90, $this->source); })()), "noteMinimale", [], "any", false, false, false, 90))) {
                // line 91
                yield "                                                    ";
                $context["successCount"] = ((isset($context["successCount"]) || array_key_exists("successCount", $context) ? $context["successCount"] : (function () { throw new RuntimeError('Variable "successCount" does not exist.', 91, $this->source); })()) + 1);
                // line 92
                yield "                                                ";
            }
            // line 93
            yield "                                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['tentative'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 94
        yield "                                            ";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["successCount"]) || array_key_exists("successCount", $context) ? $context["successCount"] : (function () { throw new RuntimeError('Variable "successCount" does not exist.', 94, $this->source); })()), "html", null, true);
        yield "
                                        </span>
                                    </li>
                                    <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                        Échecs
                                        <span class=\"badge bg-danger rounded-pill\">
                                            ";
        // line 100
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 100, $this->source); })()), "tentatives", [], "any", false, false, false, 100)) - (isset($context["successCount"]) || array_key_exists("successCount", $context) ? $context["successCount"] : (function () { throw new RuntimeError('Variable "successCount" does not exist.', 100, $this->source); })())), "html", null, true);
        yield "
                                        </span>
                                    </li>
                                    ";
        // line 103
        if ((Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 103, $this->source); })()), "tentatives", [], "any", false, false, false, 103)) > 0)) {
            // line 104
            yield "                                    <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                        Taux de réussite
                                        <span class=\"badge ";
            // line 106
            if (((((isset($context["successCount"]) || array_key_exists("successCount", $context) ? $context["successCount"] : (function () { throw new RuntimeError('Variable "successCount" does not exist.', 106, $this->source); })()) / Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 106, $this->source); })()), "tentatives", [], "any", false, false, false, 106))) * 100) >= 70)) {
                yield "bg-success";
            } elseif (((((isset($context["successCount"]) || array_key_exists("successCount", $context) ? $context["successCount"] : (function () { throw new RuntimeError('Variable "successCount" does not exist.', 106, $this->source); })()) / Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 106, $this->source); })()), "tentatives", [], "any", false, false, false, 106))) * 100) >= 40)) {
                yield "bg-warning";
            } else {
                yield "bg-danger";
            }
            yield " rounded-pill\">
                                            ";
            // line 107
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::round((((isset($context["successCount"]) || array_key_exists("successCount", $context) ? $context["successCount"] : (function () { throw new RuntimeError('Variable "successCount" does not exist.', 107, $this->source); })()) / Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["exercice"]) || array_key_exists("exercice", $context) ? $context["exercice"] : (function () { throw new RuntimeError('Variable "exercice" does not exist.', 107, $this->source); })()), "tentatives", [], "any", false, false, false, 107))) * 100), 1), "html", null, true);
            yield "%
                                        </span>
                                    </li>
                                    ";
        }
        // line 111
        yield "                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        return "admin/exercice/show.html.twig";
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
        return array (  304 => 111,  297 => 107,  287 => 106,  283 => 104,  281 => 103,  275 => 100,  265 => 94,  259 => 93,  256 => 92,  253 => 91,  250 => 90,  245 => 89,  243 => 88,  235 => 83,  221 => 71,  212 => 65,  207 => 62,  205 => 61,  200 => 59,  193 => 55,  186 => 51,  177 => 45,  167 => 44,  157 => 37,  147 => 36,  139 => 31,  124 => 19,  118 => 16,  112 => 13,  103 => 7,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/base.html.twig' %}

{% block title %}Détails de l'exercice{% endblock %}

{% block content %}
    <div class=\"container-fluid\">
        <h1 class=\"h3 mb-4 text-gray-800\">{{ exercice.titre }}</h1>

        <div class=\"card shadow mb-4\">
            <div class=\"card-header py-3 d-flex justify-content-between align-items-center\">
                <h6 class=\"m-0 font-weight-bold text-primary\">Détails de l'exercice</h6>
                <div>
                    <a href=\"{{ path('admin_exercice_pdf', {'id': exercice.id}) }}\" class=\"btn btn-info btn-sm mr-2\" target=\"_blank\">
                        <i class=\"fas fa-file-pdf\"></i> Télécharger PDF
                    </a>
                    <a href=\"{{ path('admin_exercice_edit', {'id': exercice.id}) }}\" class=\"btn btn-warning btn-sm mr-2\">
                        <i class=\"fas fa-edit\"></i> Modifier
                    </a>
                    <a href=\"{{ path('admin_exercice_index') }}\" class=\"btn btn-secondary btn-sm\">
                        <i class=\"fas fa-arrow-left\"></i> Retour
                    </a>
                </div>
            </div>
            <div class=\"card-body\">
                <div class=\"row\">
                    <div class=\"col-md-8\">
                        <table class=\"table table-bordered\">
                            <tbody>
                                <tr>
                                    <th class=\"bg-light\" style=\"width: 30%\">Titre</th>
                                    <td>{{ exercice.titre }}</td>
                                </tr>
                                <tr>
                                    <th class=\"bg-light\">Type</th>
                                    <td>
                                        <span class=\"badge {% if exercice.typeExercice == 'qcm' %}bg-info{% elseif exercice.typeExercice == 'html' or exercice.typeExercice == 'javascript' or exercice.typeExercice == 'php' %}bg-primary{% else %}bg-secondary{% endif %}\">
                                            {{ exercice.typeExercice|capitalize }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class=\"bg-light\">Niveau de difficulté</th>
                                    <td>
                                        <span class=\"badge {% if exercice.niveauDifficulte == 'facile' %}bg-success{% elseif exercice.niveauDifficulte == 'moyen' %}bg-warning{% else %}bg-danger{% endif %}\">
                                            {{ exercice.niveauDifficulte|capitalize }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th class=\"bg-light\">Note minimale</th>
                                    <td>{{ exercice.noteMinimale }}/20</td>
                                </tr>
                                <tr>
                                    <th class=\"bg-light\">Temps estimé</th>
                                    <td>{{ exercice.tempsEstime }} minutes</td>
                                </tr>
                                <tr>
                                    <th class=\"bg-light\">Créé par</th>
                                    <td>{{ exercice.user.name }}</td>
                                </tr>
                                {% if exercice.fichierPdf %}
                                <tr>
                                    <th class=\"bg-light\">Fichier PDF</th>
                                    <td>
                                        <a href=\"{{ asset('uploads/exercices/' ~ exercice.fichierPdf) }}\" target=\"_blank\" class=\"btn btn-primary btn-sm\">
                                            <i class=\"fas fa-file-pdf\"></i> Voir le PDF
                                        </a>
                                    </td>
                                </tr>
                                {% endif %}
                            </tbody>
                        </table>
                    </div>
                    <div class=\"col-md-4\">
                        <div class=\"card\">
                            <div class=\"card-header bg-primary text-white\">
                                <h6 class=\"m-0\">Statistiques</h6>
                            </div>
                            <div class=\"card-body\">
                                <ul class=\"list-group list-group-flush\">
                                    <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                        Tentatives totales
                                        <span class=\"badge bg-primary rounded-pill\">{{ exercice.tentatives|length }}</span>
                                    </li>
                                    <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                        Réussites
                                        <span class=\"badge bg-success rounded-pill\">
                                            {% set successCount = 0 %}
                                            {% for tentative in exercice.tentatives %}
                                                {% if tentative.note >= exercice.noteMinimale %}
                                                    {% set successCount = successCount + 1 %}
                                                {% endif %}
                                            {% endfor %}
                                            {{ successCount }}
                                        </span>
                                    </li>
                                    <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                        Échecs
                                        <span class=\"badge bg-danger rounded-pill\">
                                            {{ exercice.tentatives|length - successCount }}
                                        </span>
                                    </li>
                                    {% if exercice.tentatives|length > 0 %}
                                    <li class=\"list-group-item d-flex justify-content-between align-items-center\">
                                        Taux de réussite
                                        <span class=\"badge {% if (successCount / exercice.tentatives|length) * 100 >= 70 %}bg-success{% elseif (successCount / exercice.tentatives|length) * 100 >= 40 %}bg-warning{% else %}bg-danger{% endif %} rounded-pill\">
                                            {{ ((successCount / exercice.tentatives|length) * 100)|round(1) }}%
                                        </span>
                                    </li>
                                    {% endif %}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{% endblock %}
", "admin/exercice/show.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\admin\\exercice\\show.html.twig");
    }
}
