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

/* reclamation.html.twig */
class __TwigTemplate_627577b2bd6cbaa5c240a145307f7b8e extends Template
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
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "reclamation.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "reclamation.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "reclamation.html.twig", 1);
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

        yield "Reclamation - DevSphere";
        
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
        yield "    <!-- Contact Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"text-center wow fadeInUp\" data-wow-delay=\"0.1s\">
                <h6 class=\"section-title bg-white text-center text-primary px-3\">Reclamation</h6>
                <h1 class=\"mb-5\">Submit a Reclamation</h1>
            </div>
            <div class=\"row g-4\">
                <div class=\"col-lg-4 col-md-6 wow fadeInUp\" data-wow-delay=\"0.1s\">
                    <h5>Get In Touch</h5>
                    <p class=\"mb-4\">If you have any issues or concerns, please don't hesitate to contact us.</p>
                    <div class=\"d-flex align-items-center mb-3\">
                        <div class=\"d-flex align-items-center justify-content-center flex-shrink-0 bg-primary\" style=\"width: 50px; height: 50px;\">
                            <i class=\"fa fa-map-marker-alt text-white\"></i>
                        </div>
                        <div class=\"ms-3\">
                            <h5 class=\"text-primary\">Office</h5>
                            <p class=\"mb-0\">123 Street, Tunisia</p>
                        </div>
                    </div>
                    <div class=\"d-flex align-items-center mb-3\">
                        <div class=\"d-flex align-items-center justify-content-center flex-shrink-0 bg-primary\" style=\"width: 50px; height: 50px;\">
                            <i class=\"fa fa-phone-alt text-white\"></i>
                        </div>
                        <div class=\"ms-3\">
                            <h5 class=\"text-primary\">Mobile</h5>
                            <p class=\"mb-0\">+216 XX XXX XXX</p>
                        </div>
                    </div>
                    <div class=\"d-flex align-items-center\">
                        <div class=\"d-flex align-items-center justify-content-center flex-shrink-0 bg-primary\" style=\"width: 50px; height: 50px;\">
                            <i class=\"fa fa-envelope-open text-white\"></i>
                        </div>
                        <div class=\"ms-3\">
                            <h5 class=\"text-primary\">Email</h5>
                            <p class=\"mb-0\">info@devsphere.com</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-lg-8 col-md-12 wow fadeInUp\" data-wow-delay=\"0.3s\">
                    <form>
                        <div class=\"row g-3\">
                            <div class=\"col-md-6\">
                                <div class=\"form-floating\">
                                    <input type=\"text\" class=\"form-control\" id=\"name\" placeholder=\"Your Name\">
                                    <label for=\"name\">Your Name</label>
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"form-floating\">
                                    <input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Your Email\">
                                    <label for=\"email\">Your Email</label>
                                </div>
                            </div>
                            <div class=\"col-12\">
                                <div class=\"form-floating\">
                                    <input type=\"text\" class=\"form-control\" id=\"subject\" placeholder=\"Subject\">
                                    <label for=\"subject\">Subject</label>
                                </div>
                            </div>
                            <div class=\"col-12\">
                                <div class=\"form-floating\">
                                    <textarea class=\"form-control\" placeholder=\"Leave your message here\" id=\"message\" style=\"height: 150px\"></textarea>
                                    <label for=\"message\">Message</label>
                                </div>
                            </div>
                            <div class=\"col-12\">
                                <button class=\"btn btn-primary w-100 py-3\" type=\"submit\">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
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
        return "reclamation.html.twig";
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
        return array (  100 => 6,  87 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Reclamation - DevSphere{% endblock %}

{% block content %}
    <!-- Contact Start -->
    <div class=\"container-xxl py-5\">
        <div class=\"container\">
            <div class=\"text-center wow fadeInUp\" data-wow-delay=\"0.1s\">
                <h6 class=\"section-title bg-white text-center text-primary px-3\">Reclamation</h6>
                <h1 class=\"mb-5\">Submit a Reclamation</h1>
            </div>
            <div class=\"row g-4\">
                <div class=\"col-lg-4 col-md-6 wow fadeInUp\" data-wow-delay=\"0.1s\">
                    <h5>Get In Touch</h5>
                    <p class=\"mb-4\">If you have any issues or concerns, please don't hesitate to contact us.</p>
                    <div class=\"d-flex align-items-center mb-3\">
                        <div class=\"d-flex align-items-center justify-content-center flex-shrink-0 bg-primary\" style=\"width: 50px; height: 50px;\">
                            <i class=\"fa fa-map-marker-alt text-white\"></i>
                        </div>
                        <div class=\"ms-3\">
                            <h5 class=\"text-primary\">Office</h5>
                            <p class=\"mb-0\">123 Street, Tunisia</p>
                        </div>
                    </div>
                    <div class=\"d-flex align-items-center mb-3\">
                        <div class=\"d-flex align-items-center justify-content-center flex-shrink-0 bg-primary\" style=\"width: 50px; height: 50px;\">
                            <i class=\"fa fa-phone-alt text-white\"></i>
                        </div>
                        <div class=\"ms-3\">
                            <h5 class=\"text-primary\">Mobile</h5>
                            <p class=\"mb-0\">+216 XX XXX XXX</p>
                        </div>
                    </div>
                    <div class=\"d-flex align-items-center\">
                        <div class=\"d-flex align-items-center justify-content-center flex-shrink-0 bg-primary\" style=\"width: 50px; height: 50px;\">
                            <i class=\"fa fa-envelope-open text-white\"></i>
                        </div>
                        <div class=\"ms-3\">
                            <h5 class=\"text-primary\">Email</h5>
                            <p class=\"mb-0\">info@devsphere.com</p>
                        </div>
                    </div>
                </div>
                <div class=\"col-lg-8 col-md-12 wow fadeInUp\" data-wow-delay=\"0.3s\">
                    <form>
                        <div class=\"row g-3\">
                            <div class=\"col-md-6\">
                                <div class=\"form-floating\">
                                    <input type=\"text\" class=\"form-control\" id=\"name\" placeholder=\"Your Name\">
                                    <label for=\"name\">Your Name</label>
                                </div>
                            </div>
                            <div class=\"col-md-6\">
                                <div class=\"form-floating\">
                                    <input type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Your Email\">
                                    <label for=\"email\">Your Email</label>
                                </div>
                            </div>
                            <div class=\"col-12\">
                                <div class=\"form-floating\">
                                    <input type=\"text\" class=\"form-control\" id=\"subject\" placeholder=\"Subject\">
                                    <label for=\"subject\">Subject</label>
                                </div>
                            </div>
                            <div class=\"col-12\">
                                <div class=\"form-floating\">
                                    <textarea class=\"form-control\" placeholder=\"Leave your message here\" id=\"message\" style=\"height: 150px\"></textarea>
                                    <label for=\"message\">Message</label>
                                </div>
                            </div>
                            <div class=\"col-12\">
                                <button class=\"btn btn-primary w-100 py-3\" type=\"submit\">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
{% endblock %}", "reclamation.html.twig", "C:\\Users\\maram\\pi_symfony_DevSphere1\\templates\\reclamation.html.twig");
    }
}
