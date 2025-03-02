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

/* admin/dashboard/index.html.twig */
class __TwigTemplate_1fe095225ccf6a7cfaf32c9aa839c28e extends Template
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
            'body' => [$this, 'block_body'],
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/dashboard/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "admin/dashboard/index.html.twig"));

        $this->parent = $this->loadTemplate("admin/base.html.twig", "admin/dashboard/index.html.twig", 1);
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

        yield "Dashboard";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "    <div class=\"container-fluid\">
        <h1 class=\"h3 mb-4 text-gray-800\">Dashboard</h1>

        <!-- Stats Cards -->
        <div class=\"row\">
            <!-- Categories Card -->
            <div class=\"col-xl-3 col-md-6 mb-4\">
                <div class=\"card border-left-primary shadow h-100 py-2\">
                    <div class=\"card-body\">
                        <div class=\"row no-gutters align-items-center\">
                            <div class=\"col mr-2\">
                                <div class=\"text-xs font-weight-bold text-primary text-uppercase mb-1\">
                                    Catégories</div>
                                <div class=\"h5 mb-0 font-weight-bold text-gray-800\">";
        // line 19
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total_categories"]) || array_key_exists("total_categories", $context) ? $context["total_categories"] : (function () { throw new RuntimeError('Variable "total_categories" does not exist.', 19, $this->source); })()), "html", null, true);
        yield "</div>
                            </div>
                            <div class=\"col-auto\">
                                <i class=\"fas fa-folder fa-2x text-gray-300\"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courses Card -->
            <div class=\"col-xl-3 col-md-6 mb-4\">
                <div class=\"card border-left-success shadow h-100 py-2\">
                    <div class=\"card-body\">
                        <div class=\"row no-gutters align-items-center\">
                            <div class=\"col mr-2\">
                                <div class=\"text-xs font-weight-bold text-success text-uppercase mb-1\">
                                    Cours</div>
                                <div class=\"h5 mb-0 font-weight-bold text-gray-800\">";
        // line 37
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total_courses"]) || array_key_exists("total_courses", $context) ? $context["total_courses"] : (function () { throw new RuntimeError('Variable "total_courses" does not exist.', 37, $this->source); })()), "html", null, true);
        yield "</div>
                            </div>
                            <div class=\"col-auto\">
                                <i class=\"fas fa-book fa-2x text-gray-300\"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inscriptions Card -->
            <div class=\"col-xl-3 col-md-6 mb-4\">
                <div class=\"card border-left-warning shadow h-100 py-2\">
                    <div class=\"card-body\">
                        <div class=\"row no-gutters align-items-center\">
                            <div class=\"col mr-2\">
                                <div class=\"text-xs font-weight-bold text-warning text-uppercase mb-1\">
                                    Inscriptions</div>
                                <div class=\"h5 mb-0 font-weight-bold text-gray-800\">";
        // line 55
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total_inscriptions"]) || array_key_exists("total_inscriptions", $context) ? $context["total_inscriptions"] : (function () { throw new RuntimeError('Variable "total_inscriptions" does not exist.', 55, $this->source); })()), "html", null, true);
        yield "</div>
                            </div>
                            <div class=\"col-auto\">
                                <i class=\"fas fa-user-graduate fa-2x text-gray-300\"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exercices Card -->
            <div class=\"col-xl-3 col-md-6 mb-4\">
                <div class=\"card border-left-info shadow h-100 py-2\">
                    <div class=\"card-body\">
                        <div class=\"row no-gutters align-items-center\">
                            <div class=\"col mr-2\">
                                <div class=\"text-xs font-weight-bold text-info text-uppercase mb-1\">
                                    Exercices</div>
                                <div class=\"h5 mb-0 font-weight-bold text-gray-800\">";
        // line 73
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["total_exercices"]) || array_key_exists("total_exercices", $context) ? $context["total_exercices"] : (function () { throw new RuntimeError('Variable "total_exercices" does not exist.', 73, $this->source); })()), "html", null, true);
        yield "</div>
                            </div>
                            <div class=\"col-auto\">
                                <i class=\"fas fa-tasks fa-2x text-gray-300\"></i>
                            </div>
                        </div>
                        <div class=\"mt-3\">
                            <a href=\"";
        // line 80
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_index");
        yield "\" class=\"btn btn-info btn-sm btn-block\">
                                <i class=\"fas fa-cog fa-sm\"></i> Gérer les exercices
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"row\">
            <!-- Recent Categories -->
            <div class=\"col-lg-6 mb-4\">
                <div class=\"card shadow mb-4\">
                    <div class=\"card-header py-3\">
                        <h6 class=\"m-0 font-weight-bold text-primary\">Catégories récentes</h6>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"table-responsive\">
                            <table class=\"table\">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ";
        // line 106
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recent_categories"]) || array_key_exists("recent_categories", $context) ? $context["recent_categories"] : (function () { throw new RuntimeError('Variable "recent_categories" does not exist.', 106, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["categorie"]) {
            // line 107
            yield "                                        <tr>
                                            <td>";
            // line 108
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "nom", [], "any", false, false, false, 108), "html", null, true);
            yield "</td>
                                            <td>";
            // line 109
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::slice($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["categorie"], "description", [], "any", false, false, false, 109), 0, 50), "html", null, true);
            yield "...</td>
                                        </tr>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['categorie'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 112
        yield "                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Courses -->
            <div class=\"col-lg-6 mb-4\">
                <div class=\"card shadow mb-4\">
                    <div class=\"card-header py-3\">
                        <h6 class=\"m-0 font-weight-bold text-primary\">Cours récents</h6>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"table-responsive\">
                            <table class=\"table\">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ";
        // line 135
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recent_courses"]) || array_key_exists("recent_courses", $context) ? $context["recent_courses"] : (function () { throw new RuntimeError('Variable "recent_courses" does not exist.', 135, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["cours"]) {
            // line 136
            yield "                                        <tr>
                                            <td>";
            // line 137
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["cours"], "titre", [], "any", false, false, false, 137), "html", null, true);
            yield "</td>
                                            <td>";
            // line 138
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["cours"], "categorie", [], "any", false, false, false, 138), "nom", [], "any", false, false, false, 138), "html", null, true);
            yield "</td>
                                        </tr>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['cours'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 141
        yield "                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Exercices -->
            <div class=\"col-lg-12 mb-4\">
                <div class=\"card shadow mb-4\">
                    <div class=\"card-header py-3 d-flex justify-content-between align-items-center\">
                        <h6 class=\"m-0 font-weight-bold text-primary\">Exercices récents</h6>
                        <a href=\"";
        // line 153
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_index");
        yield "\" class=\"btn btn-primary btn-sm\">
                            <i class=\"fas fa-tasks fa-sm\"></i> Voir tous les exercices
                        </a>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"table-responsive\">
                            <table class=\"table\">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Niveau</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ";
        // line 169
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable((isset($context["recent_exercices"]) || array_key_exists("recent_exercices", $context) ? $context["recent_exercices"] : (function () { throw new RuntimeError('Variable "recent_exercices" does not exist.', 169, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["exercice"]) {
            // line 170
            yield "                                        <tr>
                                            <td>";
            // line 171
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "titre", [], "any", false, false, false, 171), "html", null, true);
            yield "</td>
                                            <td>
                                                <span class=\"badge bg-";
            // line 173
            yield (((CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 173) == "facile")) ? ("success") : ((((CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 173) == "moyen")) ? ("warning") : ("danger"))));
            yield "\">
                                                    ";
            // line 174
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "niveauDifficulte", [], "any", false, false, false, 174)), "html", null, true);
            yield "
                                                </span>
                                            </td>
                                            <td>";
            // line 177
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::capitalize($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "typeExercice", [], "any", false, false, false, 177)), "html", null, true);
            yield "</td>
                                            <td>
                                                <a href=\"";
            // line 179
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 179)]), "html", null, true);
            yield "\" class=\"btn btn-info btn-sm\">
                                                    <i class=\"fas fa-eye\"></i>
                                                </a>
                                                <a href=\"";
            // line 182
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("admin_exercice_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["exercice"], "id", [], "any", false, false, false, 182)]), "html", null, true);
            yield "\" class=\"btn btn-warning btn-sm\">
                                                    <i class=\"fas fa-edit\"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['exercice'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 188
        yield "                                </tbody>
                            </table>
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
        return "admin/dashboard/index.html.twig";
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
        return array (  360 => 188,  348 => 182,  342 => 179,  337 => 177,  331 => 174,  327 => 173,  322 => 171,  319 => 170,  315 => 169,  296 => 153,  282 => 141,  273 => 138,  269 => 137,  266 => 136,  262 => 135,  237 => 112,  228 => 109,  224 => 108,  221 => 107,  217 => 106,  188 => 80,  178 => 73,  157 => 55,  136 => 37,  115 => 19,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'admin/base.html.twig' %}

{% block title %}Dashboard{% endblock %}

{% block body %}
    <div class=\"container-fluid\">
        <h1 class=\"h3 mb-4 text-gray-800\">Dashboard</h1>

        <!-- Stats Cards -->
        <div class=\"row\">
            <!-- Categories Card -->
            <div class=\"col-xl-3 col-md-6 mb-4\">
                <div class=\"card border-left-primary shadow h-100 py-2\">
                    <div class=\"card-body\">
                        <div class=\"row no-gutters align-items-center\">
                            <div class=\"col mr-2\">
                                <div class=\"text-xs font-weight-bold text-primary text-uppercase mb-1\">
                                    Catégories</div>
                                <div class=\"h5 mb-0 font-weight-bold text-gray-800\">{{ total_categories }}</div>
                            </div>
                            <div class=\"col-auto\">
                                <i class=\"fas fa-folder fa-2x text-gray-300\"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courses Card -->
            <div class=\"col-xl-3 col-md-6 mb-4\">
                <div class=\"card border-left-success shadow h-100 py-2\">
                    <div class=\"card-body\">
                        <div class=\"row no-gutters align-items-center\">
                            <div class=\"col mr-2\">
                                <div class=\"text-xs font-weight-bold text-success text-uppercase mb-1\">
                                    Cours</div>
                                <div class=\"h5 mb-0 font-weight-bold text-gray-800\">{{ total_courses }}</div>
                            </div>
                            <div class=\"col-auto\">
                                <i class=\"fas fa-book fa-2x text-gray-300\"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inscriptions Card -->
            <div class=\"col-xl-3 col-md-6 mb-4\">
                <div class=\"card border-left-warning shadow h-100 py-2\">
                    <div class=\"card-body\">
                        <div class=\"row no-gutters align-items-center\">
                            <div class=\"col mr-2\">
                                <div class=\"text-xs font-weight-bold text-warning text-uppercase mb-1\">
                                    Inscriptions</div>
                                <div class=\"h5 mb-0 font-weight-bold text-gray-800\">{{ total_inscriptions }}</div>
                            </div>
                            <div class=\"col-auto\">
                                <i class=\"fas fa-user-graduate fa-2x text-gray-300\"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exercices Card -->
            <div class=\"col-xl-3 col-md-6 mb-4\">
                <div class=\"card border-left-info shadow h-100 py-2\">
                    <div class=\"card-body\">
                        <div class=\"row no-gutters align-items-center\">
                            <div class=\"col mr-2\">
                                <div class=\"text-xs font-weight-bold text-info text-uppercase mb-1\">
                                    Exercices</div>
                                <div class=\"h5 mb-0 font-weight-bold text-gray-800\">{{ total_exercices }}</div>
                            </div>
                            <div class=\"col-auto\">
                                <i class=\"fas fa-tasks fa-2x text-gray-300\"></i>
                            </div>
                        </div>
                        <div class=\"mt-3\">
                            <a href=\"{{ path('admin_exercice_index') }}\" class=\"btn btn-info btn-sm btn-block\">
                                <i class=\"fas fa-cog fa-sm\"></i> Gérer les exercices
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=\"row\">
            <!-- Recent Categories -->
            <div class=\"col-lg-6 mb-4\">
                <div class=\"card shadow mb-4\">
                    <div class=\"card-header py-3\">
                        <h6 class=\"m-0 font-weight-bold text-primary\">Catégories récentes</h6>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"table-responsive\">
                            <table class=\"table\">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% for categorie in recent_categories %}
                                        <tr>
                                            <td>{{ categorie.nom }}</td>
                                            <td>{{ categorie.description|slice(0, 50) }}...</td>
                                        </tr>
                                    {% endfor %}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Courses -->
            <div class=\"col-lg-6 mb-4\">
                <div class=\"card shadow mb-4\">
                    <div class=\"card-header py-3\">
                        <h6 class=\"m-0 font-weight-bold text-primary\">Cours récents</h6>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"table-responsive\">
                            <table class=\"table\">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% for cours in recent_courses %}
                                        <tr>
                                            <td>{{ cours.titre }}</td>
                                            <td>{{ cours.categorie.nom }}</td>
                                        </tr>
                                    {% endfor %}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Exercices -->
            <div class=\"col-lg-12 mb-4\">
                <div class=\"card shadow mb-4\">
                    <div class=\"card-header py-3 d-flex justify-content-between align-items-center\">
                        <h6 class=\"m-0 font-weight-bold text-primary\">Exercices récents</h6>
                        <a href=\"{{ path('admin_exercice_index') }}\" class=\"btn btn-primary btn-sm\">
                            <i class=\"fas fa-tasks fa-sm\"></i> Voir tous les exercices
                        </a>
                    </div>
                    <div class=\"card-body\">
                        <div class=\"table-responsive\">
                            <table class=\"table\">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Niveau</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% for exercice in recent_exercices %}
                                        <tr>
                                            <td>{{ exercice.titre }}</td>
                                            <td>
                                                <span class=\"badge bg-{{ exercice.niveauDifficulte == 'facile' ? 'success' : (exercice.niveauDifficulte == 'moyen' ? 'warning' : 'danger') }}\">
                                                    {{ exercice.niveauDifficulte|capitalize }}
                                                </span>
                                            </td>
                                            <td>{{ exercice.typeExercice|capitalize }}</td>
                                            <td>
                                                <a href=\"{{ path('admin_exercice_show', {'id': exercice.id}) }}\" class=\"btn btn-info btn-sm\">
                                                    <i class=\"fas fa-eye\"></i>
                                                </a>
                                                <a href=\"{{ path('admin_exercice_edit', {'id': exercice.id}) }}\" class=\"btn btn-warning btn-sm\">
                                                    <i class=\"fas fa-edit\"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    {% endfor %}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{% endblock %}
", "admin/dashboard/index.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\admin\\dashboard\\index.html.twig");
    }
}
