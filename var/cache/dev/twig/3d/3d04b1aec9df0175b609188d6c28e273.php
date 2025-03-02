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

/* publication/show.html.twig */
class __TwigTemplate_ae781f7a042c8b631f6e2d30d684ccc2 extends Template
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
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "publication/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "publication/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "publication/show.html.twig", 1);
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

        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 3, $this->source); })()), "titre", [], "any", false, false, false, 3), "html", null, true);
        yield " - DevSphere Forum";
        
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
        yield "    <!-- Header Start -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">";
        // line 11
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 11, $this->source); })()), "titre", [], "any", false, false, false, 11), "html", null, true);
        yield "</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_home");
        yield "\">Home</a></li>
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 15
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_publication_index");
        yield "\">Publications</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">View Publication</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Publication Content Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-8 mx-auto\">
                    <!-- Publication Header -->
                    <div class=\"bg-light rounded p-4 mb-4\">
                        <div class=\"d-flex justify-content-between mb-4\">
                            <div>
                                ";
        // line 34
        if (CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 34, $this->source); })()), "categoriePublication", [], "any", false, false, false, 34)) {
            // line 35
            yield "                                    <span class=\"badge bg-primary mb-2\">";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 35, $this->source); })()), "categoriePublication", [], "any", false, false, false, 35), "nom", [], "any", false, false, false, 35), "html", null, true);
            yield "</span>
                                ";
        }
        // line 37
        yield "                                <h2 class=\"mb-1\">";
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 37, $this->source); })()), "titre", [], "any", false, false, false, 37), "html", null, true);
        yield "</h2>
                                <div class=\"text-muted\">
                                    <small>
                                        <i class=\"far fa-user me-2\"></i>";
        // line 40
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 40, $this->source); })()), "user", [], "any", false, false, false, 40)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 40, $this->source); })()), "user", [], "any", false, false, false, 40), "email", [], "any", false, false, false, 40), "html", null, true)) : ("Anonymous"));
        yield "
                                        <i class=\"far fa-calendar-alt ms-3 me-2\"></i>";
        // line 41
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 41, $this->source); })()), "date", [], "any", false, false, false, 41), "d M Y"), "html", null, true);
        yield "
                                        <i class=\"far fa-comment ms-3 me-2\"></i>";
        // line 42
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 42, $this->source); })()), "commentaire", [], "any", false, false, false, 42)), "html", null, true);
        yield " comments
                                    </small>
                                </div>
                            </div>
                            ";
        // line 46
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER") && ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 46, $this->source); })()), "user", [], "any", false, false, false, 46) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 46, $this->source); })()), "user", [], "any", false, false, false, 46)) || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")))) {
            // line 47
            yield "                                <div class=\"dropdown\">
                                    <button class=\"btn btn-link\" type=\"button\" id=\"publicationActions\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                        <i class=\"fas fa-ellipsis-v\"></i>
                                    </button>
                                    <ul class=\"dropdown-menu\" aria-labelledby=\"publicationActions\">
                                        <li><a class=\"dropdown-item\" href=\"";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_publication_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 52, $this->source); })()), "id", [], "any", false, false, false, 52)]), "html", null, true);
            yield "\">Edit</a></li>
                                        <li>
                                            <form action=\"";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_publication_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 54, $this->source); })()), "id", [], "any", false, false, false, 54)]), "html", null, true);
            yield "\" method=\"post\" onsubmit=\"return confirm('Are you sure you want to delete this publication?');\">
                                                <input type=\"hidden\" name=\"_token\" value=\"";
            // line 55
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 55, $this->source); })()), "id", [], "any", false, false, false, 55))), "html", null, true);
            yield "\">
                                                <button class=\"dropdown-item text-danger\">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            ";
        }
        // line 62
        yield "                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class=\"bg-light rounded p-4 mb-4\">
                        <h4 class=\"mb-4\">Comments (";
        // line 67
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 67, $this->source); })()), "commentaire", [], "any", false, false, false, 67)), "html", null, true);
        yield ")</h4>
                        ";
        // line 68
        if (Twig\Extension\CoreExtension::testEmpty(CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 68, $this->source); })()), "commentaire", [], "any", false, false, false, 68))) {
            // line 69
            yield "                            <p class=\"text-muted\">No comments yet. Be the first to comment!</p>
                        ";
        } else {
            // line 71
            yield "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 71, $this->source); })()), "commentaire", [], "any", false, false, false, 71));
            foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
                // line 72
                yield "                                <div class=\"border-bottom pb-3 mb-3\">
                                    <div class=\"d-flex mb-2\">
                                        <div class=\"ps-2\">
                                            <h6 class=\"fw-bold mb-1\">";
                // line 75
                yield ((CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "user", [], "any", false, false, false, 75)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "user", [], "any", false, false, false, 75), "email", [], "any", false, false, false, 75), "html", null, true)) : ("Anonymous"));
                yield "</h6>
                                            <small class=\"text-muted\">";
                // line 76
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "date", [], "any", false, false, false, 76), "d M Y H:i"), "html", null, true);
                yield "</small>
                                        </div>
                                    </div>
                                    <p class=\"mb-0\">";
                // line 79
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "commentaire", [], "any", false, false, false, 79), "html", null, true);
                yield "</p>
                                </div>
                            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['comment'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 82
            yield "                        ";
        }
        // line 83
        yield "                    </div>

                    <!-- Actions -->
                    <div class=\"text-center mb-4\">
                        <a href=\"";
        // line 87
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_publication_index");
        yield "\" class=\"btn btn-secondary me-2\">
                            <i class=\"fas fa-arrow-left me-2\"></i>Back to Publications
                        </a>
                        ";
        // line 90
        if (($this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER") && ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 90, $this->source); })()), "user", [], "any", false, false, false, 90) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 90, $this->source); })()), "user", [], "any", false, false, false, 90)) || $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_ADMIN")))) {
            // line 91
            yield "                            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_publication_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 91, $this->source); })()), "id", [], "any", false, false, false, 91)]), "html", null, true);
            yield "\" class=\"btn btn-primary\">
                                <i class=\"fas fa-edit me-2\"></i>Edit Publication
                            </a>
                        ";
        }
        // line 95
        yield "                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Publication Content End -->
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
        return "publication/show.html.twig";
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
        return array (  269 => 95,  261 => 91,  259 => 90,  253 => 87,  247 => 83,  244 => 82,  235 => 79,  229 => 76,  225 => 75,  220 => 72,  215 => 71,  211 => 69,  209 => 68,  205 => 67,  198 => 62,  188 => 55,  184 => 54,  179 => 52,  172 => 47,  170 => 46,  163 => 42,  159 => 41,  155 => 40,  148 => 37,  142 => 35,  140 => 34,  118 => 15,  114 => 14,  108 => 11,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}{{ publication.titre }} - DevSphere Forum{% endblock %}

{% block content %}
    <!-- Header Start -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">{{ publication.titre }}</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_home') }}\">Home</a></li>
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_publication_index') }}\">Publications</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">View Publication</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Publication Content Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-8 mx-auto\">
                    <!-- Publication Header -->
                    <div class=\"bg-light rounded p-4 mb-4\">
                        <div class=\"d-flex justify-content-between mb-4\">
                            <div>
                                {% if publication.categoriePublication %}
                                    <span class=\"badge bg-primary mb-2\">{{ publication.categoriePublication.nom }}</span>
                                {% endif %}
                                <h2 class=\"mb-1\">{{ publication.titre }}</h2>
                                <div class=\"text-muted\">
                                    <small>
                                        <i class=\"far fa-user me-2\"></i>{{ publication.user ? publication.user.email : 'Anonymous' }}
                                        <i class=\"far fa-calendar-alt ms-3 me-2\"></i>{{ publication.date|date('d M Y') }}
                                        <i class=\"far fa-comment ms-3 me-2\"></i>{{ publication.commentaire|length }} comments
                                    </small>
                                </div>
                            </div>
                            {% if is_granted('ROLE_USER') and (publication.user == app.user or is_granted('ROLE_ADMIN')) %}
                                <div class=\"dropdown\">
                                    <button class=\"btn btn-link\" type=\"button\" id=\"publicationActions\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                        <i class=\"fas fa-ellipsis-v\"></i>
                                    </button>
                                    <ul class=\"dropdown-menu\" aria-labelledby=\"publicationActions\">
                                        <li><a class=\"dropdown-item\" href=\"{{ path('app_publication_edit', {'id': publication.id}) }}\">Edit</a></li>
                                        <li>
                                            <form action=\"{{ path('app_publication_delete', {'id': publication.id}) }}\" method=\"post\" onsubmit=\"return confirm('Are you sure you want to delete this publication?');\">
                                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ publication.id) }}\">
                                                <button class=\"dropdown-item text-danger\">Delete</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            {% endif %}
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class=\"bg-light rounded p-4 mb-4\">
                        <h4 class=\"mb-4\">Comments ({{ publication.commentaire|length }})</h4>
                        {% if publication.commentaire is empty %}
                            <p class=\"text-muted\">No comments yet. Be the first to comment!</p>
                        {% else %}
                            {% for comment in publication.commentaire %}
                                <div class=\"border-bottom pb-3 mb-3\">
                                    <div class=\"d-flex mb-2\">
                                        <div class=\"ps-2\">
                                            <h6 class=\"fw-bold mb-1\">{{ comment.user ? comment.user.email : 'Anonymous' }}</h6>
                                            <small class=\"text-muted\">{{ comment.date|date('d M Y H:i') }}</small>
                                        </div>
                                    </div>
                                    <p class=\"mb-0\">{{ comment.commentaire }}</p>
                                </div>
                            {% endfor %}
                        {% endif %}
                    </div>

                    <!-- Actions -->
                    <div class=\"text-center mb-4\">
                        <a href=\"{{ path('app_publication_index') }}\" class=\"btn btn-secondary me-2\">
                            <i class=\"fas fa-arrow-left me-2\"></i>Back to Publications
                        </a>
                        {% if is_granted('ROLE_USER') and (publication.user == app.user or is_granted('ROLE_ADMIN')) %}
                            <a href=\"{{ path('app_publication_edit', {'id': publication.id}) }}\" class=\"btn btn-primary\">
                                <i class=\"fas fa-edit me-2\"></i>Edit Publication
                            </a>
                        {% endif %}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Publication Content End -->
{% endblock %}
", "publication/show.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\publication\\show.html.twig");
    }
}
