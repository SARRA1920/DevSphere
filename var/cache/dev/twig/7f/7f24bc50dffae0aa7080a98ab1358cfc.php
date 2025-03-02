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

/* publication/index.html.twig */
class __TwigTemplate_10f6e07ec148eda37f25b2c34e238889 extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "publication/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "publication/index.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "publication/index.html.twig", 1);
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

        yield "Publications - DevSphere Forum";
        
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
                    <h1 class=\"display-3 text-white animated slideInDown\">Publications</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"";
        // line 14
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("home");
        yield "\">Home</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Publications</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Publications Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <!-- Flash Messages -->
            ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 28, $this->source); })()), "flashes", [], "any", false, false, false, 28));
        foreach ($context['_seq'] as $context["label"] => $context["messages"]) {
            // line 29
            yield "                ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable($context["messages"]);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 30
                yield "                    <div class=\"alert alert-";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["label"], "html", null, true);
                yield " alert-dismissible fade show\" role=\"alert\">
                        ";
                // line 31
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($context["message"], "html", null, true);
                yield "
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['message'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            yield "            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['label'], $context['messages'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        yield "
            <!-- Add New Publication Button -->
            <div class=\"text-end mb-4\">
                <a href=\"";
        // line 39
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_publication_new");
        yield "\" class=\"btn btn-primary\">
                    <i class=\"fas fa-plus-circle me-2\"></i>New Publication
                </a>
            </div>

            <!-- Publications List -->
            <div class=\"row g-4\">
                ";
        // line 46
        if (Twig\Extension\CoreExtension::testEmpty((isset($context["publications"]) || array_key_exists("publications", $context) ? $context["publications"] : (function () { throw new RuntimeError('Variable "publications" does not exist.', 46, $this->source); })()))) {
            // line 47
            yield "                    <div class=\"col-12 text-center\">
                        <p>No publications found. Be the first to create one!</p>
                    </div>
                ";
        } else {
            // line 51
            yield "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["publications"]) || array_key_exists("publications", $context) ? $context["publications"] : (function () { throw new RuntimeError('Variable "publications" does not exist.', 51, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["publication"]) {
                // line 52
                yield "                        <div class=\"col-lg-4 col-md-6 wow fadeInUp\" data-wow-delay=\"0.1s\">
                            <div class=\"course-item bg-light\">
                                <div class=\"position-relative overflow-hidden\">
                                    <div class=\"w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4\">
                                        <a href=\"";
                // line 56
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_publication_show", ["id" => CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "id", [], "any", false, false, false, 56)]), "html", null, true);
                yield "\" class=\"flex-shrink-0 btn btn-sm btn-primary px-3\">Read More</a>
                                    </div>
                                </div>
                                <div class=\"p-4\">
                                    <div class=\"d-flex justify-content-between mb-3\">
                                        <small class=\"flex-fill text-center py-2\">
                                            <i class=\"far fa-calendar-alt text-primary me-2\"></i>
                                            ";
                // line 63
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatDate(CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "date", [], "any", false, false, false, 63), "d M Y"), "html", null, true);
                yield "
                                        </small>
                                        ";
                // line 65
                if (CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "categoriepublication", [], "any", false, false, false, 65)) {
                    // line 66
                    yield "                                            <small class=\"flex-fill text-center py-2\">
                                                <i class=\"far fa-folder text-primary me-2\"></i>
                                                ";
                    // line 68
                    yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "categoriepublication", [], "any", false, false, false, 68), "name", [], "any", false, false, false, 68), "html", null, true);
                    yield "
                                            </small>
                                        ";
                }
                // line 71
                yield "                                    </div>
                                    <h5 class=\"mb-4\">";
                // line 72
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "titre", [], "any", false, false, false, 72), "html", null, true);
                yield "</h5>
                                    <div class=\"d-flex justify-content-between\">
                                        <small class=\"flex-fill text-center py-2\">
                                            <i class=\"far fa-user text-primary me-2\"></i>
                                            ";
                // line 76
                yield ((CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "user", [], "any", false, false, false, 76)) ? ($this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "user", [], "any", false, false, false, 76), "username", [], "any", false, false, false, 76), "html", null, true)) : ("Anonymous"));
                yield "
                                        </small>
                                        <small class=\"flex-fill text-center py-2\">
                                            <i class=\"far fa-comment text-primary me-2\"></i>
                                            ";
                // line 80
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(Twig\Extension\CoreExtension::length($this->env->getCharset(), CoreExtension::getAttribute($this->env, $this->source, $context["publication"], "commentaire", [], "any", false, false, false, 80)), "html", null, true);
                yield " Comments
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['publication'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 87
            yield "                ";
        }
        // line 88
        yield "            </div>
        </div>
    </div>
    <!-- Publications End -->
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
        return "publication/index.html.twig";
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
        return array (  251 => 88,  248 => 87,  235 => 80,  228 => 76,  221 => 72,  218 => 71,  212 => 68,  208 => 66,  206 => 65,  201 => 63,  191 => 56,  185 => 52,  180 => 51,  174 => 47,  172 => 46,  162 => 39,  157 => 36,  151 => 35,  141 => 31,  136 => 30,  131 => 29,  127 => 28,  110 => 14,  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Publications - DevSphere Forum{% endblock %}

{% block content %}
    <!-- Header Start -->
    <div class=\"container-fluid bg-primary py-5 mb-5 page-header\">
        <div class=\"container py-5\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-10 text-center\">
                    <h1 class=\"display-3 text-white animated slideInDown\">Publications</h1>
                    <nav aria-label=\"breadcrumb\">
                        <ol class=\"breadcrumb justify-content-center\">
                            <li class=\"breadcrumb-item\"><a class=\"text-white\" href=\"{{ path('home') }}\">Home</a></li>
                            <li class=\"breadcrumb-item text-white active\" aria-current=\"page\">Publications</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Publications Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <!-- Flash Messages -->
            {% for label, messages in app.flashes %}
                {% for message in messages %}
                    <div class=\"alert alert-{{ label }} alert-dismissible fade show\" role=\"alert\">
                        {{ message }}
                        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
                    </div>
                {% endfor %}
            {% endfor %}

            <!-- Add New Publication Button -->
            <div class=\"text-end mb-4\">
                <a href=\"{{ path('app_publication_new') }}\" class=\"btn btn-primary\">
                    <i class=\"fas fa-plus-circle me-2\"></i>New Publication
                </a>
            </div>

            <!-- Publications List -->
            <div class=\"row g-4\">
                {% if publications is empty %}
                    <div class=\"col-12 text-center\">
                        <p>No publications found. Be the first to create one!</p>
                    </div>
                {% else %}
                    {% for publication in publications %}
                        <div class=\"col-lg-4 col-md-6 wow fadeInUp\" data-wow-delay=\"0.1s\">
                            <div class=\"course-item bg-light\">
                                <div class=\"position-relative overflow-hidden\">
                                    <div class=\"w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4\">
                                        <a href=\"{{ path('app_publication_show', {'id': publication.id}) }}\" class=\"flex-shrink-0 btn btn-sm btn-primary px-3\">Read More</a>
                                    </div>
                                </div>
                                <div class=\"p-4\">
                                    <div class=\"d-flex justify-content-between mb-3\">
                                        <small class=\"flex-fill text-center py-2\">
                                            <i class=\"far fa-calendar-alt text-primary me-2\"></i>
                                            {{ publication.date|date('d M Y') }}
                                        </small>
                                        {% if publication.categoriepublication %}
                                            <small class=\"flex-fill text-center py-2\">
                                                <i class=\"far fa-folder text-primary me-2\"></i>
                                                {{ publication.categoriepublication.name }}
                                            </small>
                                        {% endif %}
                                    </div>
                                    <h5 class=\"mb-4\">{{ publication.titre }}</h5>
                                    <div class=\"d-flex justify-content-between\">
                                        <small class=\"flex-fill text-center py-2\">
                                            <i class=\"far fa-user text-primary me-2\"></i>
                                            {{ publication.user ? publication.user.username : 'Anonymous' }}
                                        </small>
                                        <small class=\"flex-fill text-center py-2\">
                                            <i class=\"far fa-comment text-primary me-2\"></i>
                                            {{ publication.commentaire|length }} Comments
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {% endfor %}
                {% endif %}
            </div>
        </div>
    </div>
    <!-- Publications End -->
{% endblock %}
", "publication/index.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\publication\\index.html.twig");
    }
}
