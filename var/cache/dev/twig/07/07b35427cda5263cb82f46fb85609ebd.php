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

/* forum/show.html.twig */
class __TwigTemplate_5413daee9af853f50782388ca4c29b1e extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/show.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "forum/show.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "forum/show.html.twig", 1);
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
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum");
        yield "\">Forum</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Topic</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Topic Content Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-8 mx-auto\">
                    <!-- Topic Header -->
                    <div class=\"bg-light rounded p-4 mb-4\">
                        <div class=\"d-flex justify-content-between mb-4\">
                            <div>
                                <span class=\"badge bg-primary mb-2\">";
        // line 34
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 34, $this->source); })()), "category", [], "any", false, false, false, 34), "category", [], "any", false, false, false, 34), "value", [], "any", false, false, false, 34), "html", null, true);
        yield "</span>
                                <h2 class=\"mb-1\">";
        // line 35
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 35, $this->source); })()), "titre", [], "any", false, false, false, 35), "html", null, true);
        yield "</h2>
                                <div class=\"text-muted\">
                                    <small>
                                        <i class=\"far fa-user me-2\"></i>";
        // line 38
        yield ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 38, $this->source); })()), "user", [], "any", false, false, false, 38)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 38, $this->source); })()), "user", [], "any", false, false, false, 38), "email", [], "any", false, false, false, 38), "html", null, true)) : ("Anonymous"));
        yield "
                                        <i class=\"far fa-clock ms-3 me-2\"></i>";
        // line 39
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 39, $this->source); })()), "date", [], "any", false, false, false, 39), "d M Y"), "html", null, true);
        yield "
                                        <i class=\"far fa-comment ms-3 me-2\"></i>";
        // line 40
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 40, $this->source); })()), "commentaires", [], "any", false, false, false, 40)), "html", null, true);
        yield " comments
                                    </small>
                                </div>
                            </div>
                            ";
        // line 44
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 44, $this->source); })()), "user", [], "any", false, false, false, 44) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 44, $this->source); })()), "user", [], "any", false, false, false, 44))) {
            // line 45
            yield "                                <div>
                                    <div class=\"dropdown\">
                                        <button class=\"btn btn-link\" type=\"button\" id=\"topicActions\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                            <i class=\"fas fa-ellipsis-v\"></i>
                                        </button>
                                        <ul class=\"dropdown-menu\" aria-labelledby=\"topicActions\">
                                            <li><a class=\"dropdown-item\" href=\"";
            // line 51
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 51, $this->source); })()), "id", [], "any", false, false, false, 51)]), "html", null, true);
            yield "\">Edit</a></li>
                                            <li>
                                                <form action=\"";
            // line 53
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 53, $this->source); })()), "id", [], "any", false, false, false, 53)]), "html", null, true);
            yield "\" method=\"post\" onsubmit=\"return confirm('Are you sure you want to delete this topic?');\">
                                                    <input type=\"hidden\" name=\"_token\" value=\"";
            // line 54
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 54, $this->source); })()), "id", [], "any", false, false, false, 54))), "html", null, true);
            yield "\">
                                                    <button class=\"dropdown-item text-danger\">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
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
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 67, $this->source); })()), "commentaires", [], "any", false, false, false, 67)), "html", null, true);
        yield ")</h4>
                        
                        <!-- Comment Form -->
                        <form action=\"";
        // line 70
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_comment", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 70, $this->source); })()), "id", [], "any", false, false, false, 70)]), "html", null, true);
        yield "\" method=\"post\" class=\"mb-4\">
                            <div class=\"form-group\">
                                <textarea class=\"form-control mb-3\" name=\"comment\" rows=\"3\" placeholder=\"Write your comment...\" required></textarea>
                                <button type=\"submit\" class=\"btn btn-primary\">Post Comment</button>
                            </div>
                        </form>

                        <!-- Comments List -->
                        ";
        // line 78
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 78, $this->source); })()), "commentaires", [], "any", false, false, false, 78));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["comment"]) {
            // line 79
            yield "                            <div class=\"d-flex mb-4\">
                                <div class=\"flex-grow-1 bg-white p-3 rounded\">
                                    <div class=\"d-flex justify-content-between mb-2\">
                                        <h6 class=\"mb-0\">";
            // line 82
            yield ((CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "user", [], "any", false, false, false, 82)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "user", [], "any", false, false, false, 82), "email", [], "any", false, false, false, 82), "html", null, true)) : ("Anonymous"));
            yield "</h6>
                                        <small class=\"text-muted\">";
            // line 83
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "date", [], "any", false, false, false, 83), "d M Y H:i"), "html", null, true);
            yield "</small>
                                    </div>
                                    <p class=\"mb-0\">";
            // line 85
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "contenu", [], "any", false, false, false, 85), "html", null, true);
            yield "</p>
                                    ";
            // line 86
            if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 86, $this->source); })()), "user", [], "any", false, false, false, 86) == CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "user", [], "any", false, false, false, 86))) {
                // line 87
                yield "                                        <div class=\"mt-2\">
                                            <form action=\"";
                // line 88
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_comment_delete", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 88)]), "html", null, true);
                yield "\" method=\"post\" style=\"display: inline-block\">
                                                <input type=\"hidden\" name=\"_token\" value=\"";
                // line 89
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderCsrfToken(("delete" . CoreExtension::getAttribute($this->env, $this->source, $context["comment"], "id", [], "any", false, false, false, 89))), "html", null, true);
                yield "\">
                                                <button class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Are you sure?')\">Delete</button>
                                            </form>
                                        </div>
                                    ";
            }
            // line 94
            yield "                                </div>
                            </div>
                        ";
            $context['_iterated'] = true;
        }
        // line 98
        if (!$context['_iterated']) {
            // line 97
            yield "                            <p class=\"text-muted\">No comments yet. Be the first to comment!</p>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['comment'], $context['_parent'], $context['_iterated']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 99
        yield "                    </div>

                    <!-- Actions -->
                    <div class=\"text-center mb-4\">
                        <a href=\"";
        // line 103
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum");
        yield "\" class=\"btn btn-secondary me-2\">
                            <i class=\"fas fa-arrow-left me-2\"></i>Back to Forum
                        </a>
                        ";
        // line 106
        if ((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 106, $this->source); })()), "user", [], "any", false, false, false, 106) == CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 106, $this->source); })()), "user", [], "any", false, false, false, 106))) {
            // line 107
            yield "                            <a href=\"";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_forum_edit", ["id" => CoreExtension::getAttribute($this->env, $this->source, (isset($context["publication"]) || array_key_exists("publication", $context) ? $context["publication"] : (function () { throw new RuntimeError('Variable "publication" does not exist.', 107, $this->source); })()), "id", [], "any", false, false, false, 107)]), "html", null, true);
            yield "\" class=\"btn btn-primary\">
                                <i class=\"fas fa-edit me-2\"></i>Edit Topic
                            </a>
                        ";
        }
        // line 111
        yield "                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topic Content End -->
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
        return "forum/show.html.twig";
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
        return array (  296 => 111,  288 => 107,  286 => 106,  280 => 103,  274 => 99,  267 => 97,  265 => 98,  259 => 94,  251 => 89,  247 => 88,  244 => 87,  242 => 86,  238 => 85,  233 => 83,  229 => 82,  224 => 79,  219 => 78,  208 => 70,  202 => 67,  195 => 62,  184 => 54,  180 => 53,  175 => 51,  167 => 45,  165 => 44,  158 => 40,  154 => 39,  150 => 38,  144 => 35,  140 => 34,  118 => 15,  114 => 14,  108 => 11,  101 => 6,  88 => 5,  64 => 3,  41 => 1,);
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
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('app_forum') }}\">Forum</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Topic</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Topic Content Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-8 mx-auto\">
                    <!-- Topic Header -->
                    <div class=\"bg-light rounded p-4 mb-4\">
                        <div class=\"d-flex justify-content-between mb-4\">
                            <div>
                                <span class=\"badge bg-primary mb-2\">{{ publication.category.category.value }}</span>
                                <h2 class=\"mb-1\">{{ publication.titre }}</h2>
                                <div class=\"text-muted\">
                                    <small>
                                        <i class=\"far fa-user me-2\"></i>{{ publication.user ? publication.user.email : 'Anonymous' }}
                                        <i class=\"far fa-clock ms-3 me-2\"></i>{{ publication.date|date('d M Y') }}
                                        <i class=\"far fa-comment ms-3 me-2\"></i>{{ publication.commentaires|length }} comments
                                    </small>
                                </div>
                            </div>
                            {% if app.user == publication.user %}
                                <div>
                                    <div class=\"dropdown\">
                                        <button class=\"btn btn-link\" type=\"button\" id=\"topicActions\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">
                                            <i class=\"fas fa-ellipsis-v\"></i>
                                        </button>
                                        <ul class=\"dropdown-menu\" aria-labelledby=\"topicActions\">
                                            <li><a class=\"dropdown-item\" href=\"{{ path('app_forum_edit', {'id': publication.id}) }}\">Edit</a></li>
                                            <li>
                                                <form action=\"{{ path('app_forum_delete', {'id': publication.id}) }}\" method=\"post\" onsubmit=\"return confirm('Are you sure you want to delete this topic?');\">
                                                    <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ publication.id) }}\">
                                                    <button class=\"dropdown-item text-danger\">Delete</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            {% endif %}
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class=\"bg-light rounded p-4 mb-4\">
                        <h4 class=\"mb-4\">Comments ({{ publication.commentaires|length }})</h4>
                        
                        <!-- Comment Form -->
                        <form action=\"{{ path('app_forum_comment', {'id': publication.id}) }}\" method=\"post\" class=\"mb-4\">
                            <div class=\"form-group\">
                                <textarea class=\"form-control mb-3\" name=\"comment\" rows=\"3\" placeholder=\"Write your comment...\" required></textarea>
                                <button type=\"submit\" class=\"btn btn-primary\">Post Comment</button>
                            </div>
                        </form>

                        <!-- Comments List -->
                        {% for comment in publication.commentaires %}
                            <div class=\"d-flex mb-4\">
                                <div class=\"flex-grow-1 bg-white p-3 rounded\">
                                    <div class=\"d-flex justify-content-between mb-2\">
                                        <h6 class=\"mb-0\">{{ comment.user ? comment.user.email : 'Anonymous' }}</h6>
                                        <small class=\"text-muted\">{{ comment.date|date('d M Y H:i') }}</small>
                                    </div>
                                    <p class=\"mb-0\">{{ comment.contenu }}</p>
                                    {% if app.user == comment.user %}
                                        <div class=\"mt-2\">
                                            <form action=\"{{ path('app_forum_comment_delete', {'id': comment.id}) }}\" method=\"post\" style=\"display: inline-block\">
                                                <input type=\"hidden\" name=\"_token\" value=\"{{ csrf_token('delete' ~ comment.id) }}\">
                                                <button class=\"btn btn-sm btn-danger\" onclick=\"return confirm('Are you sure?')\">Delete</button>
                                            </form>
                                        </div>
                                    {% endif %}
                                </div>
                            </div>
                        {% else %}
                            <p class=\"text-muted\">No comments yet. Be the first to comment!</p>
                        {% endfor %}
                    </div>

                    <!-- Actions -->
                    <div class=\"text-center mb-4\">
                        <a href=\"{{ path('app_forum') }}\" class=\"btn btn-secondary me-2\">
                            <i class=\"fas fa-arrow-left me-2\"></i>Back to Forum
                        </a>
                        {% if app.user == publication.user %}
                            <a href=\"{{ path('app_forum_edit', {'id': publication.id}) }}\" class=\"btn btn-primary\">
                                <i class=\"fas fa-edit me-2\"></i>Edit Topic
                            </a>
                        {% endif %}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topic Content End -->
{% endblock %}
", "forum/show.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\forum\\show.html.twig");
    }
}
